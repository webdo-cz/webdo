<?php

namespace App\Models\Eshop;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $table = "eshop_order_address";
    public $timestamps = false; 

    public function order()
    {
        return $this->where('type', 'order');
    }

    public function delivery()
    {
        return $this->where('type', 'delivery');
    }
}
