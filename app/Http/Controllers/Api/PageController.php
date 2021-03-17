<?php

namespace App\Http\Controllers\Api;

use App\Models\Post as Page;
use App\Models\Content;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function page($name) {
        $state = Content::usingLocale('cs')->where('page', $name)->with('children')->get();

        $page = Page::where('slug', $name);
        $thumbnail = $page->first()->files->where('type', 'thumbnail')->first();
        $page = $page->first([
            'page_title', 
            'meta_title', 
            'meta_description', 
            'meta_keywords'
        ])->toArray();
        $page['thumbnail'] = $thumbnail['full_path'];

        $content = ContentResource::collection($state->toTree(null)->keyBy('name'));

        return [
            'page' => $page,
            'content' => $content
        ];
    }
}