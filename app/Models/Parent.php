<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parents';

    protected $fillable = ['auth_key_id'];
    
    
    /**
     * The children that belong a given parent.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany('App\Models\Child', 'child_parents', 'parent_id', 'child_id');
    }

    /**
     * Get the key for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function authKey()
    {
        return $this->hasOne('App\Models\AuthKey', 'auth_key_id');
    }

    /**
     * Get the default pickup hours for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function defaultPickupHours()
    {
        return $this->hasOne('App\Models\DefaultPickupHours');
    }

    /**
     * Get the bills for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    /**
     * Get the fines for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fines()
    {
        return $this->hasMany('App\Models\Fine');
    }
}
