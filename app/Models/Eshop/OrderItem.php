<?php

namespace App\Models\Eshop;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "eshop_order_items";
    protected $hidden = ['order_id', 'product_id', 'variant_id', 'created_at', 'updated_at'];

    public function variant()
    {
        return $this->belongsTo('App\Models\Eshop\Variant', 'variant_id');
    }
}
