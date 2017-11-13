<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Get all the activities
     */
    public function authKeys()
    {
        return $this->hasMany('App\Models\AuthKey');
    }
}
