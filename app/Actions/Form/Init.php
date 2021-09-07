<?php

namespace App\Actions\Form;

use App\Models\Post;
use App\Models\Term;
use App\Models\File;
use Illuminate\Support\Str;

trait Init
{
    public $terms;

    public $state = [
        'status' => "published",
        'custom_teaser' => false,
    ];
    public $teaser;

    public $upload = [
        'gallery' => [],
        'files' => []
    ];
    
    public function init()
    {
        $this->terms = Term::where('post_type', $this->type)->get();

        if($this->method == "edit") {
            $state = Post::with(['variant', 'variants'])->findOrFail($this->uid);
            $this->state = $state->toArray();
            if($state->custom_teaser) {
                $this->teaser = $state->teaser;
            }

            $this->state['gallery'] = $state->files->where('type', 'gallery')->toArray();
            $this->state['files'] = $state->files->where('type', 'files')->toArray();

            $prevStaticThumbnail = $state->files->where('type', 'thumbnail')->first();
            $prevHoverThumbnail = $state->files->where('type', 'hover-thumbnail')->first();
            if(isset($prevStaticThumbnail)) {
                $this->state['thumbnail']['prev-static'] = $prevStaticThumbnail->toArray();
            }
            if(isset($prevHoverThumbnail)) {
                $this->state['thumbnail']['prev-hover'] = $prevHoverThumbnail->toArray();
            }

            $this->state['terms'] = $state->terms->pluck('id')->toArray();
        }else {
            $this->state['id'] = strtoupper(Str::random(4)) . str_shuffle(date("jmi"));
            $this->state['gallery'] = [];
            $this->state['files'] = [];

            $this->state['thumbnail'] = [];

            $this->state['terms'] = [];
        }
    }
}