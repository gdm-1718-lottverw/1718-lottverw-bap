<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ChildResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => (string)$this->name,
            'parent' => (object)$this->parents,
            'parent' => ParentResource::collection($this->whenLoaded('parents')),
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}