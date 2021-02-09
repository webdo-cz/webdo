<?php

namespace App\View\Web;

use App\Models\Post;
use Livewire\Component;

class Articles extends Component
{
    public $articles;

    public function mount()
    {
        $this->articles = Post::where('type', 'article')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('web.articles');
    }
}
