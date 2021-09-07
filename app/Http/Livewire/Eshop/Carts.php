<?php

namespace App\Http\Livewire\Eshop;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\OrderAddress;
use Livewire\WithPagination;
use Livewire\Component;

class Carts extends Component
{
    use WithPagination;

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
        
    }

    public function render()
    {
        $carts = Order::where('cart', '1')->orderBy('created_at', 'desc')->paginate(25);
        return view('livewire.eshop.carts')->with('carts', $carts);;
    }
}
