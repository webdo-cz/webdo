<?php

namespace App\Http\Livewire\Eshop;

use App\Models\Post;
use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;

use Livewire\Component;

class Dashboard extends Component
{
    public $counts, $countsSend;
    public $products, $warehouse, $totals, $totalsMonth;

    public function mount()
    {
        $this->products = Post::where('type', 'product')->get();

        $this->totals = Order::where('cart', '0')
        ->whereNotIn('status',['canceled', 'waiting-for-payment'])
        ->where('submited_at', '>=', \Carbon\Carbon::today()->subMonth())
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get([
            \DB::raw('Date(submited_at) as date'),
            \DB::raw('SUM(total) as "total"')
        ])->keyBy('date')->toArray();

        $this->totalsMonth = Order::where('cart', '0')
        ->whereNotIn('status',['canceled', 'waiting-for-payment'])
        ->where( \DB::raw('YEAR(submited_at)'), '=', \Carbon\Carbon::now('Y') )
        ->selectRaw('year(created_at) year, month(created_at) month, SUM(total) as "total"')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get()->keyBy('month')->toArray();

        $ordersSend = Order::where('cart', '0')->whereIn('status',['send', 'delivered', 'done'])->pluck('id');
        $orders = Order::where('cart', '0')->whereNotIn('status',['canceled', 'waiting-for-payment'])->pluck('id');

        $this->countsSend = \DB::table('eshop_order_items')->whereIn('order_id', $ordersSend)
        ->select('variant_id',\DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('variant_id')
        ->get()->keyBy('variant_id')
        ->toArray();
        $this->counts = \DB::table('eshop_order_items')->whereIn('order_id', $orders)
        ->select('variant_id',\DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('variant_id')
        ->get()->keyBy('variant_id')
        ->toArray();

        $variants = OrderItem::whereIn('order_id', $ordersSend)->orderBy('name')->get()->unique('variant_id')->keyBy('name');
        

        $this->warehouse = collect($variants)->map(function ($variant, $name) {
            return [
                'name' => $name,
                'all' => $this->counts[$variant->variant_id]->total_quantity,
                'send' => $this->countsSend[$variant->variant_id]->total_quantity
            ];
        });
    }

    public function render()
    {
        return view('livewire.eshop.dashboard');
    }
}