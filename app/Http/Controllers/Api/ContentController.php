<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function page($name) {
        $base = Content::where('group', null)
            ->where('page', $name)
            ->orderBy('order', 'asc')
            ->get()
            ->keyBy('name');
        $groups = Content::where('group', '!=' , null)
            ->where('page', $name)
            ->orderBy('order', 'asc')
            ->get();
        
        $base = ContentResource::collection($base);
        $groups = ContentResource::collection($groups)
            ->collection
            ->groupBy(['group','child'], true)
            ->map(function ($pb) { 
                return $pb->map(function ($pb) {
                    return $pb->keyBy('name')->pluck('value', 'name'); 
                }); 
            });

        foreach($groups as $key => $group) {
            $base[$key]['value'] = $group;
        }

        return $base;
    }
}
