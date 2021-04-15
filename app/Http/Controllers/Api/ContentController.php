<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Term;
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
            $order = Order::where('code', $code)->firstOrFail();
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

        $this->return['cart'] = [
            'shipments' => Shipment::where('active', 1)->get(),
            'payments' => Payment::where('active', 1)->get(),
            'items' => $cart, 
            'total' => $total,
            'cartStatus' => $cartStatus,
        ];
    }

    public function getProduct($slug) {
        $product = Post::where('slug', $slug)->first();

        if(!$product) {
            return $this->return['product'] = null;
        }

        $this->return['meta'] = [
            'page_title' => $product->page_title,
            'meta_title' => $product->meta_title , 
            'meta_description' => $product->meta_description, 
            'meta_keywords' => $product->meta_keywords
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
        $state = Content::usingLocale('cs')->where('page', $name)->with('children')->get();

        $page = Post::where('type', 'page')->where('slug', $name);

        if($page->exists()) {
            $thumbnail = $page->first()->files->where('type', 'thumbnail')->first();
            $meta = $page->first([
                'page_title', 
                'meta_title', 
                'meta_description', 
                'meta_keywords'
            ])->toArray();
            $meta['thumbnail'] = $thumbnail['full_path'] ?? null;
    
            $content = ContentResource::collection($state->toTree(null)->keyBy('name'));
        }        

        $this->return['meta'] = $meta ?? null;
        $this->return['page'] = $content ?? null;
    }
}
