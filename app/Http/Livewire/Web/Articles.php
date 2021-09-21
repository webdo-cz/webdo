<?php

namespace App\Http\Livewire\Web;

use App\Models\Post;
use Livewire\WithPagination;

use Livewire\Component;

class Articles extends Component
{
    public function render()
    {
        $articles = Post::where('type', 'article')->orderBy('created_at', 'desc')->paginate(25);
        return view('livewire.web.articles')->with('articles', $articles);
    }
}