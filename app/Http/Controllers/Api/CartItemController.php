<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
//use App\Models\Eshop\Variant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartItemController extends Controller
{
    private $request;

    private $order;
    private $cartStatus;
    private $actionStatus;

    public function store(Request $request)
    {
        $this->request =  $request;

        $this->getOrder();

        $item = $this->request->input('item');
        $order = $this->order;

        $orderItem = OrderItem::where('order_id', $order->id)->where('product_id', $item['product'])->where('variant_id', $item['variant']);

        if($orderItem->exists()) {
            $orderItem = $orderItem->first();
            $orderItem->quantity = $orderItem->quantity + $item['quantity'];
            $orderItem->save();
        }else {
            $details = Post::find($item['product']);
            $orderItem = new OrderItem;
            $orderItem->name = $details->title . " - " . $details->variants->find($item['variant'])->name;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product'];
            $orderItem->variant_id = $item['variant'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();
        }

        $cart = $this->request->input('cart');

        if(isset($cart['code'])) {
            $items = OrderItem::where('order_id', $order->id)->get();
            
            $total = 0;
            foreach($items as $item) {
                $total = $total + ($item->variant->price_include_VAT * $item->quantity);
            }

            $order->total = $total;
            $order->save();
            $count = $items->count();
        }else {
            $order->total = $orderItem->variant->price_include_VAT * $orderItem->quantity;
            $order->save();
            $count = 1;
        }

        return [
            'cart' => [
                "code" => $order->code,
                "count" => $count,
                "total" => $order->total,
            ], 
            'cartStatus' => $this->cartStatus,
            'actionStatus' => $this->actionStatus,
        ];
    }

    public function update(Request $request)
    {
        $item = OrderItem::find($request->input('id'));
        $order = Order::find($item->order_id);
        if($request->input('quantity') > 0) {
            $item->quantity = $request->input('quantity');
            $item->save();
        }else {
            $item->delete();
        }

        $items = OrderItem::where('order_id', $order->id)->get();
            
        $total = 0;
        foreach($items as $item) {
            $total = $total + ($item->variant->price_include_VAT * $item->quantity);
        }

        $order->total = $total;
        $order->save();
        $count = $items->count();

        return [
            'cart' => [
                "code" => $order->code,
                "count" => $count,
                "total" => $order->total,
            ]
        ];
    }

    public function delete(Request $request)
    {
        $item = OrderItem::find($request->input('id'));
        $order = Order::find($item->order_id);
        $item->delete();

        $items = OrderItem::where('order_id', $order->id)->get();
            
        $total = 0;
        foreach($items as $item) {
            $total = $total + ($item->variant->price_include_VAT * $item->quantity);
        }

        $order->total = $total;
        $order->save();
        $count = $items->count();

        return [
            'cart' => [
                "code" => $order->code,
                "count" => $count,
                "total" => $order->total,
            ]
        ];
    }

    private function getOrder()
    {
        $cart = $this->request->input('cart');

        if(isset($cart['code'])) {
            $code = $cart['code'];
            $order = Order::where('code', '=', $code)->first();
            if($order) {
                $cartStatus = "cart-found";
            }else {
                $order = $this->createNewOrder();
                $cartStatus = "cart-not-found";
            }
        }else {
            $order = $this->createNewOrder();
            $cartStatus = "created-new-cart";
        }

        $this->order = $order;
        $this->cartStatus = $cartStatus;
    }

    private function createNewOrder()
    {
        $order = new Order;
        $order->code = strtoupper(Str::random(4)) . str_shuffle(date("mdy")) . str_shuffle(date("His"));
        $order->status = 'open';
        $order->total = 0;
        $order->save();
        return $order;
    }
}
