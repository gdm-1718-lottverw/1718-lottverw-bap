<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    protected $fillable = ['auth_key_id'];
    /**
     * Get all the activities
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }
    
    /**
     * Get all the addresses
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'organization_id');
    }
     
    /**
     * Get all the children
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Models\Child');
    }
    
    /**
     * Get all the Planned Attendance
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function PlannedAttendance()
    {
        return $this->hasMany('App\Models\PlannedAttendance');
    }

    /**
     * Get all the parent organizations
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parentOrganizations()
    {
        return $this->hasMany('App\Models\Organizations', 'main_organization', 'id');
    }

    /**
     * Get all the OpeningHours
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OpeningHours()
    {
        return $this->hasMany('App\Models\OpeningHour');
    }
    
    /**
     * Get all the Closed
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Closed()
    {
        return $this->hasMany('App\Models\Closed');
    }

    /**
     * Get the auth key record associated with the organization.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authKey()
    {
        return $this->hasOne('App\Models\AuthKey', 'auth_key_id');
    }
}
