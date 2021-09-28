<?php

namespace App\Http\Livewire\Web;

use App\Models\Post;
use Livewire\WithPagination;

use Livewire\Component;

class Subpages extends Component
{
    public function render()
    {
        $subpages = Post::where('type', 'subpage')->orderBy('created_at', 'desc')->paginate(25);
        return view('livewire.web.subpages')->with('subpages', $subpages);
    }
}