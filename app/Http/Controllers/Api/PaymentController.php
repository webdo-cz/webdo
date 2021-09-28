<?php

namespace App\Http\Controllers\Api;

use App\Models\Eshop\Order;
use App\Actions\Integrations\Gopay\PaymentStatus;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    use PaymentStatus;

    public function status($id)
    {
        $payment = $this->get($id);
        if(($payment['state'] ?? false) == 'PAID') {
            $order = Order::where('payment_code', $payment['order_number'])->first();
            $order->status = "waiting-for-packing";
            $order->save();
        }
        return [
            'status' => $payment['state'] ?? 'FAIL'
        ];
    }
}