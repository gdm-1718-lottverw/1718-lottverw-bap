<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
class ChildPlanResource extends Resource
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
            'planned' => (object)$this->plannedAttendance,
            'planned' => PlannedAttendanceResource::collection($this->whenLoaded('plannedAttendance')),
        ];
    }
}