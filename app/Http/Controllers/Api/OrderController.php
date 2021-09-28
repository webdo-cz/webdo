<?php

namespace App\Http\Controllers\Api;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\OrderAddress;
use App\Mail\OrderSend;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Actions\Integrations\Gopay\GeneratePayment;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use GeneratePayment;

    private $order;

    public function __construct(Request $request)
    {
        $cart = $request->input('cart');
        $this->order = Order::where('code', '=', $cart['code'])->first();
    }

    public function fill(Request $request)
    {
        $cart = $request->input('cart');
        $data = $request->input('order');

        $this->fillOrderFields($cart['code'], $data);

        $this->order->save();
        
        return [
            'status' => 'done'
        ];
    }

    public function submit(Request $request)
    {
        $cart= $request->input('cart');
        $data = $request->input('order');

        Validator::make($data, [
            'email' => 'required|email',
            'telephone' => 'required',
            'shipment_id' => 'required',
            //'shipment_code' => 'required',
            'payment_id' => 'required',
            //'payment_code' => 'required',
            'order_name' => 'required',
            'order_surname' => 'required',
            'order_street' => 'required',
            'order_number' => 'required',
            'order_city' => 'required',
            'order_post_code' => 'required',
            'order_state' => 'required',
        ])->validate();

        $this->fillOrderFields($cart['code'], $data);

        $this->order->status = "waiting-for-packing";
        $this->order->cart = 0;
        $this->order->submited_at = now();

        $items = OrderItem::where('order_id', $this->order->id)->get();
        $total = 0;
        foreach($items as $item) {
            $total = $total + ($item->variant->price * $item->quantity);
        }
        $total = $total + $this->order->payment->price + $this->order->shipment->price;
        $this->order->total = $total;
        $this->order->payment_code = date('mdHi') . mt_rand(10, 99);

        if($this->order->payment->name == 'banktransfer') {
            $this->order->status = "waiting-for-payment";
        }elseif($this->order->payment->name == 'gopay-platba-kartou') {
            $params = [
                'contact' => [
                    'first_name' => $this->order->address['order']->name,
                    'last_name' => $this->order->address['order']->surname,
                    'email' => $this->order->email,
                    'phone_number' => $this->order->telephone,
                    'city' => $this->order->address['order']->city,
                    'street' => $this->order->address['order']->street,
                    'postal_code' => $this->order->address['order']->post_code,
                    'country_code' => 'CZE'
                ],
                'total' => $this->order->total,
                'payment_code' => $this->order->payment_code,
            ];

            $payment = $this->generate($params);
            $this->order->status = "waiting-for-payment";
        }

        $this->order->save();

        $email = [
            'order' => $this->order,
            'products' => $items,
        ];

        try {

            Mail::to($this->order->email)->send(new OrderSend($email));
          
        } catch (\Exception $e) {

            $this->order->status = "email-send-fail";
            $this->order->save();
            
        }

        return [
            'status' => 'done',
            'redirect' => $payment['url'] ?? null,
            'payment_id' => $payment['id'] ?? null
        ];
    }

    private function fillOrderFields($code, $data)
    {
        $address = [];
        foreach($data as $key => $field) {
            $type = explode("_", $key);
            $type = $type[0];
            if($type == 'delivery' || $type == 'order') {
                $key = str_replace($type. "_", "", $key);
                if(!isset($address[$type])){
                    $address[$type] = OrderAddress::where('order_id', '=', $this->order->id)->where('type', '=', $type)->first();
                }
                if($address[$type]) {
                    $address[$type]->{$key} = $field;
                }else {
                    $address[$type] = new OrderAddress;
                    $address[$type]->{$key} = $field;
                    $address[$type]->type = $type;
                    $address[$type]->order_id = $this->order->id;
                }
            }else {
                $this->order->{$key} = $field;
            }
        }
        foreach($address as $address) {
            $address->save();
        }
    }
}
