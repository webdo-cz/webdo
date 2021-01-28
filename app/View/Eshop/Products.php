<?php

namespace App\View\Eshop;

use App\Models\Post;
use Livewire\Component;

class Products extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Post::where('type', 'product')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('eshop.products');
    }
}
