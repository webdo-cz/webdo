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
        if($this->variant){
            $price = $this->variant->price;
            if(config('request_locale')['currency_label']['default'] != true){
                
                //$this->variant->currency->where('')
            }

            $label = $this->variant->availability;
        }elseif($this->variants->first()) {
            $price = $this->variants->first()->price;

            $label = $this->variants->first()->availability;
            if($this->variants->count() > 1){
                $availability = $this->variants->groupBy('availability');
                if(isset($availability['Skladem'])) {
                    if(count($availability) == 1) {
                        $label = 'Skladem: ' . $availability['Skladem']->first()->name . " - " . $availability['Skladem']->last()->name;
                    }else {
                        $label = 'Skladem: ';
                        foreach($availability['Skladem'] as $variant) {
                            $label .= $variant->name . ", ";
                        }
                        $label = rtrim($label, ", ");
                    }
                }
            }
        }

        return [
            'title' => $this->title,
            'teaser' => $this->teaser,
            'slug' => $this->slug,
            'price' => $price ?? null,
            'price_label' => config('request_locale')['currency_label'],
            'availability' => $label ?? null,
            'thumbnail' => [
                'static' => $this->files->where('type', 'thumbnail')->first()->full_path ?? null,
                'hover' => $this->files->where('type', 'hover-thumbnail')->first()->full_path ?? null,
            ]
        ];
    }
}
