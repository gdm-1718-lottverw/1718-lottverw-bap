<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    
    /**
     * The children that belong a given parent.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany('App\Models\Child');
    }

    /**
     * Get the key for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function authKey()
    {
        return $this->hasOne('App\Models\AuthKey');
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
