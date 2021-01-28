<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Term;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductShowResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($term = null) {
        if($term) {
            $products = Term::where('slug', $term)->firstOrFail();
            return [
                'title' => $products->name,
                'products' => ProductIndexResource::collection($products->posts),
            ];
        }else {
            $products = Post::get();
            return [
                'products' => ProductIndexResource::collection($products),
            ];
        }
    }

    public function show($slug) {
        $products = Post::where('slug', $slug)->firstOrFail();
        
        return new ProductShowResource($products);
    }
}
