<?php

namespace App\View\Web;

use App\Models\Post;
use App\Models\Content;
use Livewire\Component;

class Dashboard extends Component
{
    public $posts;
    public $pages;
    public $events;
    public $lastEdit;

    public function mount() {
        $this->posts = Post::where('type', 'post')->count();
        $this->pages = Post::where('type', 'page')->count();
        $this->events = Post::where('type', 'event')->count();
        $post = Post::orderBy('updated_at', 'desc')->first();
        $content = Content::orderBy('updated_at', 'desc')->first();
        if($post) {
            $post = $post->toArray()['updated_at'];
        }
        if($content) {
            $content = $content->toArray()['updated_at'];
        }
        if($post && $content) {
            if($content > $post) {
                $this->lastEdit = $content;
            }else {
                $this->lastEdit = $post;
            }
        }elseif($post) {
            $this->lastEdit = $post;
        }elseif($content) {
            $this->lastEdit = $content;
        }
    }

    public function render()
    {
        return view('web.dashboard');
    }
}
