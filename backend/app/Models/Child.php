<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /**
     * Get the activities for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activities()
    {
        return $this->belongsToMany('App\Models\Activity');
    }

    /**
     * Get the guardians for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guardians()
    {
        return $this->belongsToMany('App\Models\Guardian');
    }

    /**
     * Get the parents for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parents()
    {
        return $this->belongsToMany('App\Models\Parents');
    }

    /**
     * Get the allergies associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allergies()
    {
        return $this->hasMany('App\Models\Allergie');
    }

    /**
     * Get the addresses for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Addres');
    }

    /**
     * Get the medical reports associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalReport()
    {
        return $this->hasMany('App\Models\MedicalReport');
    }

    /**
     * Get the planned attendance associated with the doctor.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plannedAttendance()
    {
        return $this->hasMany('App\Models\PlannedAttendance');
    }
    /**
     * Get the pedagogic reports associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedagogicReport()
    {
        return $this->hasMany('App\Models\PedagogicReport');
    }

    /**
     * Get the addidional information  associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addidionalInformation()
    {
        return $this->hasMany('App\Models\OtherInformation');
    }
}
