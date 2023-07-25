<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Module extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'description' => $this->description,
            'course' => $this->course->name,
        ];
    }
}
