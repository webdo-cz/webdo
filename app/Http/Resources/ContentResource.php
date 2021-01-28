<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == "group") {
            return [
                'label' => $this->label,
                'value' => $this->value,
            ];
        }else {
            return $this->value;
        }
        
    }
}
