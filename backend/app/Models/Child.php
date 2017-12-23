<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Carbon\Carbon;
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
            if(is_array($value)){
                foreach($value as $val){
                    $max = Carbon::now()->subYear((int)$val)->format('Y');
                    $min = Carbon::now()->subYear(((int)$val) + 2)->format('Y');
                    $query->orWhere([
                        ['date_of_birth', '>=', $min], 
                        ['date_of_birth', '<=', $max], 
                    ]);
                } 
            } else {
                $max = Carbon::now()->subYear((int)$value[0])->format('Y');
                $min = Carbon::now()->subYear(((int)$value[0]) + 2)->format('Y');
                $query->where([
                   ['date_of_birth', '>=', $min], 
                   ['date_of_birth', '<=', $max], 
               ]);
            }
           
        }
    }
    public function scopeAllergieJoin($query, $conditions)
    {
        $query->join('allergies', 'allergies.children_id', 'children.id', 'chlidren');
        foreach($conditions as $column => $value)
        {
            if(Count($value > 1)){
                foreach($value as $val){
                    $query->where(function($q)use($val){
                        [
                            ['allergies.type', '=', $val]
                        ];
                    });
                }
            } 
            else {
                $query->where(function($q)use($value){
                    [
                        ['allergies.type', '=', $value[0]]
                    ];
                });
            }
        }
    }    
    
    public function scopeGeneral($query, $conditions)
    {

        $query->join('planned_attendances', 'planned_attendances.child_id', 'children.id', 'chlidren');
        foreach($conditions as $column => $value)
        {
            if(is_array($value)){
                foreach($value as $val){
                    $query->where(function($q)use($val){
                        [
                            ['allergies.type', '=', $val]
                        ];
                    });
                }
            } 
            else {
                $query->where(function($q)use($value,$column){
                    [
                        ['planned_attendances.' . $column, '=', $value]
                    ];
                });
            }
            
        }

    }  
}
