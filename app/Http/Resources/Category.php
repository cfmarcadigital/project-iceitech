<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Video as VideoResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$videos = VideoResource::collection($this->videos);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            //'videos' => $videos
        ];
    }
}
