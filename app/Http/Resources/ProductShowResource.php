<?php

namespace App\Http\Resources;

use App\Http\Resources\PostGalleryResource;
use App\Http\Resources\ProductVariantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->variant) {
            $variants = [ 'variant' =>  new ProductVariantResource($this->variant)];
        }else {
            $variants = [ 'variants' => ProductVariantResource::collection($this->variants)];
        }
        return array_merge(parent::toArray($request), array_merge([
            'id' => $this->id,
            'body' => $this->body,
            'gallery' => PostGalleryResource::collection($this->files->where('type', 'gallery')),
            'children' => ProductChildrenResource::collection($this->children),
        ], $variants));
    }
}
