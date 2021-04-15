<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'thumbnail' => $this->product->files->where('type', 'thumbnail')->first()->full_path,
            'name' => $this->name,
            'price' => $this->variant->price_include_VAT,
            'quantity' => $this->quantity,
            'total' => $this->quantity * $this->variant->price_include_VAT,
        ];
    }
}
