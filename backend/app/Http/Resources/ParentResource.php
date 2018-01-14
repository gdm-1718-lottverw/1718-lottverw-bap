<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ParentResource extends Resource
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
            'child' => (object)$this->children,
            'child' => ChildResource::collection($this->whenLoaded('children')),
            
        ];
    }
}