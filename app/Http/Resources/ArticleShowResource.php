<?php

namespace App\Http\Resources;

use App\Http\Resources\PostGalleryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShowResource extends ArticleIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'gallery' => PostGalleryResource::collection($this->files->where('type', 'gallery'))
        ]);
    }
}
