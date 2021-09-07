<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasTranslations;

    public $incrementing = false;

    public $translatable = ['title','teaser','body','slug','page_title','meta_title','meta_description','meta_keywords'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function terms()
    {
        return $this->belongsToMany('App\Models\Term');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File')->orderBy('created_at', 'desc');
    }

    public function contentVersions()
    {
        return $this->hasMany('App\Models\ContentVersion', 'post_id');
    }

    public function variant()
    {
        return $this->hasOne('App\Models\Eshop\ProductVariant', 'product_id')->where('name', 'one-variant');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\Eshop\ProductVariant', 'product_id')->where('name', '!=', 'one-variant');
    }

    public function children()
    {
        return $this->belongsToMany('App\Models\Post', 'post_relations', 'parent_post_id', 'child_post_id');
    }

    // public function thumbnail()
    // {
    //     return $this->hasOne('App\Models\File')->where('type', 'thumbnail')->orderBy('created_at', 'desc');
    // }

    // public function gallery()
    // {
    //     return $this->hasMany('App\Models\File')->where('type', 'gallery')->orderBy('created_at', 'desc');
    // }

    // public function getPriceAttribute()
    // {
    //     if($this->variants->first() != null) {
    //         $same = true;
    //         $min = (float)$this->variants->first()->price;

    //         foreach($this->variants as $item) {
    //             if($min > (float)$item->price) {
    //                 $min = $item->price;
    //                 $same = false;
    //             }elseif($min < (float)$item->price) {
    //                 $same = false;
    //             }
    //         }
    //         if($same) {
    //             return $min;
    //         }else {
    //             return "od: " . $min;
    //         }
    //     }
    // }
}
