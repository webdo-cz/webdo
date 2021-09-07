<?php

namespace App\Http\Controllers\Api;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\Shipment;
use App\Models\Eshop\Payment;
use App\Http\Resources\CartShowResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function show(Request $request)
    {
        //$request = json_decode($request->input('cart'), true);
        $request = $request->input('cart');
        if(isset($request['code'])) {
            $order = Order::where('code', $request['code'])->firstOrFail();
            $cart = OrderItem::where('order_id', $order->id)->get();

            if($cart->count() == 0){
                $cart = "empty";
                $total = null;
                $cartStatus = 'step1';
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
        return [
            'shipment_options' => Shipment::where('active', 1)->get(),
            'payment_options' => Payment::where('active', 1)->get(),
            'cart' => $cart, 
            'total' => $total,
            'cartStatus' => $cartStatus,
        ];
    }
}
