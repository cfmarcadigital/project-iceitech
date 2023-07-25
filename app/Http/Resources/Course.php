<?php

namespace App\Http\Resources;

use App\Http\Resources\Module as ModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
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
            'module_duration' => $this->module_duration,
            'description' => $this->description,
            'link' => $this->link,
            'requirements' => $this->requirements,
            'modality' => $this->modality,
            'schedules' => $this->schedules,
            'image' => $this->image->path,
            'category' => $this->category->name,
            'modules' => ModuleResource::collection($this->modules)
        ];
    }
}
