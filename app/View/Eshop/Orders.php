<?php

namespace App\View\Eshop;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\OrderAddress;
use Livewire\Component;

class Orders extends Component
{
    public $orders;
    public $order;
    public $cart;
    public $statuses = [
        'canceled',
        'waiting-for-payment',
        'waiting-for-packing',
        'packing',
        'waiting-for-send',
        'send',
        'delivered',
        'done'
    ];
    public $status;

    public function showOrder($id)
    {
        $this->order = Order::find($id);
        $this->cart = OrderItem::where('order_id', $this->order->id)->get();
        $this->status = array_search($this->order->status, $this->statuses);
    }

    public function closeOrder()
    {
        $this->order = null;
    }

    public function changeStatus($status, $id)
    {
        $this->order->status = $status;
        $this->order->save();
        $this->status = $id;
        $this->orders->find($this->order->id)->status = $status;
    }

    public function mount()
    {
        $this->orders = Order::where('cart', '0')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('eshop.orders');
    }
}
