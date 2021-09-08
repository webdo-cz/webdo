<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Term;
use App\Models\Locale;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductShowResource;
use App\Models\Content;
use App\Http\Resources\ContentResource;
use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\Shipment;
use App\Models\Eshop\Payment;
use App\Http\Resources\CartShowResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public $return = []; 
    public function handle(Request $request) {
        $options = json_decode($request->getContent(), true);
        $locale = config('locales')[$options['locale'] ?? Locale::where('default', true)->value('name')] ?? ['name' => 'czech', 'label' => 'czech', 'lang' => 'cs', 'currency' => 'Kč', 'currency_label' => 'Kč'];
        config()->set([
            'request_locale' => $locale,
        ]);
        if(isset($options['subpage'])) {
            $this->getSubPage($options['subpage']);
        }

        if(isset($options['page'])) {
            $this->getPage($options['page']);
        }
        
        if(isset($options['products'])) {
            $this->getProducts($options['products']);
        }

        if(isset($options['product'])) {
            $this->getProduct($options['product']);
        }

        if(isset($options['cart'])) {
            $this->getCart($options['cart']);
        }

        return $this->return;
    }

    public function getCart($code) {

        if(is_array($code)) $code = $code['code'];
        if(isset($code)) {
            $order = Order::where('code', $code)->where('cart', '1')->first();
            if($order) {
                $cart = OrderItem::where('order_id', $order->id)->get();

                if($cart->count() == 0){
                    $cart = "empty";
                    $total = null;
                    $cartStatus = 'empty';
                }else {
                    $cart = CartShowResource::collection($cart);
                    $total = $order->total;
                    $cartStatus = 'step1';
                }
            }else {
                $cart = "empty";
                $total = null;
                $cartStatus = 'empty';
            }
        }else {
            $cart = "empty";
            $total = null;
            $cartStatus = 'empty';
        }

        $this->return['cart'] = [
            'shipments' => Shipment::where('active', 1)->get(),
            'payments' => Payment::where('active', 1)->get(),
            'items' => $cart, 
            'total' => $total,
            'cartStatus' => $cartStatus,
        ];
    }

    public function getProduct($slug) {
        $product = Post::where('slug', 'LIKE', '%' . $slug . '%')->first()->setLocale('cs');

        if(!$product) {
            return $this->return['product'] = null;
        }

        $this->return['meta'] = [
            'page_title' => $product->page_title ? $product->page_title : $product->title,
            'seo_title' => $product->seo_title ? $product->page_title : $product->title,  
            'seo_description' => $product->seo_description, 
            'seo_keywords' => $product->seo_keywords
        ];
        $this->return['product'] = new ProductShowResource($product);
    }

    public function getProducts($options) {
        $return = [];

        if(isset($options['term'])) {
            $term = Term::where('slug', $options['term'])->firstOrFail();
            $return['title'] = $term->name;
            $products = $term->posts;
        }else {
            $products = Post::get();
        }

        $products = $products->where('type', 'product');

        $return['records'] = ProductIndexResource::collection($products);

        $this->return['products'] = $return;
    }

    public function getPage($name) {
        $page = Post::where('type', 'page')->where('slug', 'LIKE', '%' . $name . '%');

        if($page->exists()) {
            $page = $page->first();

            $version = $page->contentVersions->where('slug', 'main')->first();

            $state = Content::usingLocale('cs')->where('version_id', $version->id)->with('children')->get();

            $thumbnail = $page->files->where('type', 'thumbnail')->first();
            $meta = [
                'page_title' => $page->page_title ? $page->page_title : config('option.title_prefix') . $page->title . config('option.title_suffix'),
                'seo_title' => $page->seo_title ? $page->seo_title : $page->title, 
                'seo_description' => $page->seo_description, 
                'seo_keywords' => $page->seo_keywords
            ];
            $meta['thumbnail'] = $thumbnail['full_path'] ?? null;
    
            $content = ContentResource::collection($state->toTree(null)->keyBy('name'));
        }        

        $this->return['meta'] = $meta ?? null;
        $this->return['page'] = $content ?? null;
    }

    public function getSubPage($slug) {
        $page = Post::where('type', 'subpage')->where('slug', 'LIKE', '%' . $slug . '%')->first();

        if($page) {
            $meta = [
                'page_title' => $page->page_title ? $page->page_title : config('option.title_prefix') . $page->title . config('option.title_suffix'),
                'meta_title' => $page->meta_title ? $page->page_title : $page->title, 
                'meta_description' => $page->meta_description, 
                'meta_keywords' => $page->meta_keywords
            ];

            $content = [
                'title' => $page->title,
                'body' => $page->body, 
                'slug' => $page->slug
            ];
        }        

        $this->return['meta'] = $meta ?? null;
        $this->return['page'] = $content ?? null;
    }
}
