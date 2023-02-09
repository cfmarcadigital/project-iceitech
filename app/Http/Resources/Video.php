<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;

class Video extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories = CategoryResource::collection($this->categories);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'author' => $this->author,
            'publication_date' => $this->created_at->format('d-m-Y'),
            'categories' => $categories
        ];
    }
}
