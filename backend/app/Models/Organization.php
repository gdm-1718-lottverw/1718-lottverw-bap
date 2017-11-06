<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * Get all the activities
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }
    
    /**
     * Get all the addresses
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }
     
    /**
     * Get all the children
     */
    public function children()
    {
        return $this->hasMany('App\Models\Child');
    }
    
    /**
     * Get all the Planned Attendance
     */
    public function PlannedAttendance()
    {
        return $this->hasMany('App\Models\PlannedAttendance');
    }

    /**
     * Get all the Planned Attendance
     */
    public function parentOrganizations()
    {
        return $this->hasMany('App\Models\Organizations', 'parent_id');
    }

    /**
     * Get all the OpeningHours
     */
    public function OpeningHours()
    {
        return $this->hasMany('App\Models\OpeningHour');
    }
    
    /**
     * Get all the Closed
     */
    public function Closed()
    {
        return $this->hasMany('App\Models\Closed');
    }

    /**
     * Get the auth key record associated with the organization.
     */
    public function authKey()
    {
        return $this->hasOne('App\Models\AuthKey');
    }
}
