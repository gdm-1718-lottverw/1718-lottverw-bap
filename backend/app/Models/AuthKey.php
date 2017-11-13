<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthKey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_keys';
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
    
    /**
     * Get the role a given key.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
