<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthKey extends Model
{
    /**
     * Get the role a given key.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
