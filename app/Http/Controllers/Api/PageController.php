<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function page($name) {
        $state = Content::usingLocale('cs')->where('page', $name)->with('children')->get();

        return ContentResource::collection($state->toTree(null)->keyBy('name'));
    }
}