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
        return [
            'title' => $this->title,
            'teaser' => $this->teaser,
            'slug' => $this->slug,
            'price' => $price,
            'thumbnail' => [
                'static' => $static,
                'hover' => $hover,
            ]
        ];
    }
}
