<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /**
     * The children that belong to the activities.
     */
    public function activities()
    {
        return $this->belongsToMany('App\Models\Activity');
    }
}
