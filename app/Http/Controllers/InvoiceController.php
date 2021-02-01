<?php

namespace App\Http\Controllers;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\Invoice;
use LaravelDaily\Invoices\Invoice as PdfInvoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function show($number) {
        $invoice = Invoice::where('number', $number)->firstOrFail();
        $order = Order::find($invoice->order_id);
        $cart = OrderItem::where('order_id', $order->id)->get();

        if($order->address['order']->state == 'czech') {
            $order->address['order']->state = "Česká republika";
        }

        $customer = new Buyer([
            'name'          => $order->address['order']->name . " " . $order->address['order']->surname,
            'address'       => $order->address['order']->street . " " . $order->address['order']->number,
            'custom_fields' => [
                'address_2' => $order->address['order']->post_code . " " . $order->address['order']->city,
                'state' => $order->address['order']->state,
            ],
        ]);

        $fileName = str_shuffle(date("jmi")) . strtolower($order->address['order']->surname) . $invoice->prefix . $invoice->number . '.pdf';

        $invoicePdf = PdfInvoice::make()
            ->serialNumberFormat($invoice->prefix . $invoice->number)
            ->date($invoice->created_at)
            ->buyer($customer)
            ->filename($fileName);

        foreach($cart as $item) {
            $item = (new InvoiceItem())->title($item->name)->pricePerUnit($item->variant->price_include_VAT)->quantity($item->quantity);
            $invoicePdf = $invoicePdf->addItem($item);
        }

        if($order->shipment->price > 0) {
            $item = (new InvoiceItem())->title('Doprava: ' . $order->shipment->title)->pricePerUnit($order->shipment->price);
            $invoicePdf = $invoicePdf->addItem($item);
        }

        if($order->payment->price > 0) {
            $item = (new InvoiceItem())->title($order->payment->title)->pricePerUnit($order->payment->price);
            $invoicePdf = $invoicePdf->addItem($item);
        }
        
        // if($invoice->sale) {
        //     $invoicePdf = $invoicePdf->discountByPercent($invoice->sale);
        // }
        
        return $invoicePdf->stream();
    }

    public function generate($orderId)
    {
        $latest = Invoice::whereYear('created_at', '=', date('Y'))->orderBy('created_at', 'desc')->pluck('number')->first();
        if(!$latest) {
            $latest = date('y') * 1000000;
        }
        if(!Invoice::where('order_id', $orderId)->exists()) {
            $invoice = new Invoice;
            $invoice->prefix = "FA";
            $invoice->number = $latest+1;
            $invoice->order_id = $orderId;
            $invoice->save();
        }else{
            $invoice = Invoice::where('order_id', $orderId)->first();
        }
        return redirect('invoice/show/' . $invoice->number);
    }
}
