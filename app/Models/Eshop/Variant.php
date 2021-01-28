<?php

namespace App\Models\Eshop;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = "eshop_product_variants";
    protected $hidden = ['product_id', 'active', 'created_at', 'updated_at'];

    public function getVATLabelAttribute()
    {
        if($this->VAT_rate == '0%') {
            return '';
        }elseif($this->VAT_rate == '21%') {
            return 's DPH';
        }else {
            return 's DPH ve výši ' . $this->VAT_rate;
        }
    }
}
