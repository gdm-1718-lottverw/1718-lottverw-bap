<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Child extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'children';
    /**
     * Get the activities for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activities()
    {
        return $this->belongsToMany('App\Models\Activity')->using('App\Models\ActivityChild');
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
        return $this->belongsToMany('App\Models\Parents', 'child_parents',  'child_id', 'parent_id');
    }

    /**
     * Get the parents for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    /**
     * Get the allergies associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allergies()
    {
        return $this->hasMany('App\Models\Allergie', 'children_id');
    }

    /**
     * Get the logs associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Log');
    }

    /**
     * Get the addresses for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'children_id');
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
     * Get the planned attendance associated with the child.
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
    
    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAge($query, $range)
    {
        // Calculate the min and max for each checkbox.
        $min = Carbon::now()->subYear((int)$range[0])->format('Y-m-d'); // go back at least x years
        $max = Carbon::now()->subYear(((int)$range[1]))->format('Y-m-d'); // go back until x years
        $query->whereBetween('date_of_birth', [$max, $min]);
    }


    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBirthday($query, $active)
    {
        $active == true? $query->whereMonth('date_of_birth', Carbon::now()->month): null;
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGeneral($query, $conditions)
    { 
        // we use this scope first so the join will be global and can be used in the
        // following scopes.
        $query = $query->leftJoin('planned_attendances As pa', 'children.id', '=', 'pa.child_id');
        foreach($conditions as $column => $value){
            $query->where([
                ['pa.'.$column,'=', $value]
            ]);
        }
    }
   /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePresence($query, $presence)
    {          
        switch($presence){
            case 'present_registered':
                $query->where([
                    ['pa.in', '=', false],
                    ['pa.out', '=', false]
                ]);
                break;
            case 'present_present':
                $query->where([
                    ['pa.in', '=', true],
                    ['pa.out', '=', false]
                ]);
                break;
            case 'present_out':
                $query->where([
                    ['pa.in', '=', true],
                    ['pa.out', '=', true]
                ]);
                break;
            default:
                break;
                
            }
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date   
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $conditions)
    { 
        if(Count($conditions) >= 1){
            foreach($conditions as $column => $value){
                $query->whereIn('pa.'.$column, $value);
            }
        }
        
    }
    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date   
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePictures($query, $bool)
    { 
        $bool == true ? $query->where('children.pictures', $bool): null; 
    }
    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date   
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePottyTrained($query, $bool)
    { 
        $bool == true ? $query->where('children.potty_trained', $bool): null; 
    }
     /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date   
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllergies($query, $conditions)
    {  
        $query = $query->leftJoin('allergies As al', 'children.id', '=', 'al.children_id');
        foreach($conditions as $column => $value){
            $query->whereIn('al.type', $value);
        }
        
    }

    
   
}
