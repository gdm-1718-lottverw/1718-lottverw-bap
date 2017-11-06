<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Get all the activities
     */
    public function authKeys()
    {
        return $this->hasMany('App\Models\AuthKey');
    }
}
