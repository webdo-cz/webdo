<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $incrementing = false;

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

    public function variants()
    {
        return $this->hasMany('App\Models\Eshop\Variant', 'product_id');
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
