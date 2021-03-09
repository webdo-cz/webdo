<?php

namespace App\Http\Resources;

use App\Http\Resources\ContentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == 'list') {
            return [
                'label' => $this->label,
                'value' => ContentResource::collection($this->children->keyBy('name'))
            ];
        }elseif($this->type == 'group') {
            return ContentResource::collection($this->children->keyBy('name'));
        }else {
            return $this->value;
        }
    }
}
