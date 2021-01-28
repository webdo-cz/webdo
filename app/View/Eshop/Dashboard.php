<?php

namespace App\View\Eshop;

use App\Models\Eshop\Order;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $ordersDay;
    public $ordersWeek;
    public $ordersMonth;
    public $valueWeek;

    public function mount() {
        $this->ordersDay = Order::where('cart', '0')->whereDate('updated_at', Carbon::today())->count();
        $this->ordersWeek = Order::where('cart', '0')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $this->ordersMonth = Order::where('cart', '0')->whereMonth('updated_at', Carbon::now()->month)->count();
        $this->valueWeek = Order::where('cart', '0')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->avg('total');
    }

    public function render()
    {
        return view('eshop.dashboard');
    }
}