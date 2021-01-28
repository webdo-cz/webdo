<?php

namespace App\Models\Eshop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "eshop_orders";
    protected $hidden = ['created_at', 'updated_at'];

    // public function items()
    // {
    //     return $this->hasMany('App\Models\Eshop\OrderItem', 'order_id');
    // }

    public function address()
    {
        return $this->hasMany('App\Models\Eshop\OrderAddress', 'order_id');
    }

    public function getAddressAttribute()
    {
        return $this->getRelationValue('address')->keyBy('type');
    }

    public function shipment()
    {
        return $this->belongsTo('App\Models\Eshop\Shipment', 'shipment_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Eshop\Payment', 'payment_id');
    }

    public function Invoice()
    {
        return $this->hasOne('App\Models\Eshop\Invoice', 'order_id');
    }
}
