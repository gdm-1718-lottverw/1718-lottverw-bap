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

    public function registry()
    {
        return $this->hasManyThrough('App\Models\PlannedAttendance', 'App\Models\ChildParent', 'parent_id', 'child_id', 'planned_attendance_id', 'id');
    }
     /**
     * Get the addresses for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'parent_id');
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
     * Get the no show for a given parent
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noShow()
    {
        return $this->hasMany('App\Models\NoShow');
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
