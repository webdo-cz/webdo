<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Eshop\Shipment;
use App\Http\Controllers\Controller;

class XmlController extends Controller
{
    public $shop, $products, $shipments;

    public function getData() {
        $this->shop = Post::where('type', 'page')->where('slug', 'index')->first();
        $this->products = Post::where('type', 'product')->get();
        $this->shipments = Shipment::where('active', '1')->get();
    }

    public function glami() {
        $this->getData();
        return response()->view('xml.glami', [
            'shop' => $this->shop,
            'products' => $this->products,
            'shipments' => $this->shipments,
        ])->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }

    public function heureka() {
        $this->getData();
        return response()->view('xml.heureka', [
            'shop' => $this->shop,
            'products' => $this->products,
            'shipments' => $this->shipments,
        ])->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }

    public function zboziCz() {
        $this->getData();
        return response()->view('xml.zbozi-cz', [
            'shop' => $this->shop,
            'products' => $this->products,
            'shipments' => $this->shipments,
        ])->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }

    public function googleShoping() {
        $this->getData();
        return response()->view('xml.google-shoping', [
            'shop' => $this->shop,
            'products' => $this->products,
            'shipments' => $this->shipments,
        ])->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }
}
