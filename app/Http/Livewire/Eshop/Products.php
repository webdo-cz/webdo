<?php

namespace App\Http\Livewire\Eshop;

use App\Models\Post;

use Livewire\Component;

class Products extends Component
{
    public function mount()
    {
        
    }

    public function render()
    {
        $products = Post::where('type', 'product')->orderBy('created_at', 'desc')->paginate(25);
        return view('livewire.eshop.products')->with('products', $products);
    }
}