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
    public function scopeAge($query, $conditions)
    {
        foreach($conditions as $column => $value)
        {
            // instatiate a min / max container
            $array_min = []; $array_max = [];
            // Loop over every min / max
            foreach($value as $val){
                $max = Carbon::now()->subYear((int)$val)->format('Y-m-d'); array_push($array_max, $max); 
                $min = Carbon::now()->subYear(((int)$val) + 2)->format('Y-m-d'); array_push($array_min, $min);
                echo '</br> '.'</br> '. $min . '  ---  ' . $max;
            }  
            // sort the min array 
            sort($array_min);
            sort($array_max);
            $min = $array_min[0]; 
            $max = $array_max[0];
            // ALS MAX > 12
            if(Carbon::parse($array_min[0])->format('Y') == Carbon::now()->subYear('14')->format('Y')){
                $query->whereDate('children.date_of_birth', '>', $min);
            }
            // ALS ER EEN GAT IS ZORG DAN DAT ER NIETS UIT WORDT GENOMEN
            if( $array_max[0] < array_pop($array_min)){
                echo '</br> ' . '</br> ' . $array_max[0]  .  ' < '  . array_pop($array_min);
                $query
                    ->whereBetween('children.date_of_birth', [$min, $max])
                    ->whereNotBetween('children.date_of_birth', [$array_max[0], array_pop($array_min)]);
            } else {
                $query
                    ->whereDate('children.date_of_birth', '>', $min)
                    ->whereDate('children.date_of_birth', '<', $max);
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
    public function scopePresent($query, $presence)
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
    public function scopePicture($query, $bool)
    { 
        $query->where('children.picture', $bool);
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
