<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleIndexResource extends JsonResource
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
            'title' => $this->title,
            'teaser' => $this->teaser,
            'slug' => $this->slug,
            'thumbnail' => [
                'static' => $this->files->where('type', 'thumbnail')->first()->full_path ?? null,
                'hover' => $this->files->where('type', 'hover-thumbnail')->first()->full_path ?? null,
            ]
        ];
    }
}
