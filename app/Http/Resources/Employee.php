<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->type == 1)
            return [
                'id' => $this->id,
                'type' => $this->type,
                'name' => $this->name,
                'email' => $this->email,
                'profession' => $this->profession,
                'description' => $this->description,
                'github' => $this->github,
                'linkedin' => $this->linkedin,
                'image' => $this->image->path,    
            ];

        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'email' => $this->email,
            'profession' => $this->profession,
            'description' => $this->description,
            'linkedin' => $this->linkedin,
            'image' => $this->image->path,    
        ];
    }
}
