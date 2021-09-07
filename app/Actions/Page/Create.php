<?php

namespace App\Actions\Page;

use App\Models\Post;
use App\Models\ContentVersion;
use Auth;
use Illuminate\Support\Str;

trait Create
{
    public function create()
    {
        $record = new Post;
        $record->id = strtoupper(Str::random(4)) . str_shuffle(date("jmi"));
        $record->title = $this->create['title'];
        $record->slug = $this->create['slug'];
        $record->type = $this->create['type'];
        $record->user_id = Auth::id();
        $record->save();

        $version = new ContentVersion;
        $version->name = 'Hlavní verze';
        $version->slug = 'main';
        $version->post_id = $record->id;
        $version->type = 'main';
        $version->save();

        if($this->create['type'] == 'page') {
            flashSuccess([
                'title' => 'Stránka vytvořena',
                'message' => 'Stránka byla úspěšně vytvořena.',
            ], $this);
        }else {
            flashSuccess([
                'title' => 'Komponenta vytvořena',
                'message' => 'Komponenta byla úspěšně vytvořena.',
            ], $this);
        }

        $this->create = null;
    }
}