<?php

namespace App\View\Web;

use App\Models\Post;
use Livewire\Component;

class Pages extends Component
{
    public $pages;

    public function mount()
    {
        $this->pages = Post::where('type', 'page')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('web.pages');
    }
}