<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthKey extends Model
{
    /**
    * Get the user that owns the phone.
    */
    public function user()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
