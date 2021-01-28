<?php

namespace App\View\Eshop;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\OrderAddress;
use Livewire\Component;

class Carts extends Component
{
    public $carts;
    public $cart;

    public function showCart($id)
    {
        $this->cart = Order::find($id);
        $this->cart->items = OrderItem::where('order_id', $this->cart->id)->get();
        $this->cart->address = $this->cart->address->keyBy('type');
    }

    public function closeCart()
    {
        $this->cart = null;
    }

    public function mount()
    {
        $this->carts = Order::where('cart', '1')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('eshop.carts');
    }
}
