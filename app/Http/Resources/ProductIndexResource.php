<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = null;
        $static = $this->files->where('type', 'thumbnail')->first();
        $hover = $this->files->where('type', 'hover-thumbnail')->first();
        if(isset($this->variants->first()->price_include_VAT)) {
            $price = $this->variants->first()->price_include_VAT;
        }
        if($static) {
            $static = $static->full_path;
        }
        if($hover) {
            $hover = $hover->full_path;
        }

        $availability = $this->variants->groupBy('availability');

        if(isset($availability['Vyprodáno'])) {
            if(isset($availability['Skladem'])) {
                $label = '<span style="color: #10b981; padding-right: 0.25rem;">Skladem</span> ';
                foreach($availability['Skladem'] as $variant) {
                    $label .= $variant->name . ", ";
                }
                $label = rtrim($label, ", ");
            }else {
                $label = '<span style="color: #dc2625">Vyprodáno</span>';
            }
        }else {
            $label = '<span style="color: #10b981; padding-right: 0.25rem;">Skladem</span> ' . $availability['Skladem']->first()->name . " - " . $availability['Skladem']->last()->name;
        }
        return [
            'title' => $this->title,
            'teaser' => $this->teaser,
            'slug' => $this->slug,
            'price' => $price,
            'availability' => $label,
            'thumbnail' => [
                'static' => $static,
                'hover' => $hover,
            ]
        ];
    }
}
