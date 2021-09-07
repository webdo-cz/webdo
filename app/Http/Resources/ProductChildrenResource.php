<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductChildrenResource extends JsonResource
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
        if(isset($this->variants->first()->price)) {
            $price = $this->variants->first()->price;
        }
        if($static) {
            $static = $static->full_path;
        }

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $price,
            'price_label' => config('request_locale')['currency_label'],
            'thumbnail' => [
                'static' => $static
            ]
        ];
    }
}
