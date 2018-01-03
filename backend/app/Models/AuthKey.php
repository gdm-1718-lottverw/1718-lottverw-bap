<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class AuthKey extends Model implements Authenticatable
{
    use AuthenticableTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_keys';
    
    protected $fillable = ['username', 'password', 'role_id'];
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

    /**
     * Get the parent that owns the key.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Parents');
    }

    /**
     * Get the organization that owns the key.
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
