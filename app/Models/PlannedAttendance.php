<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PlannedAttendance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'planned_attendances';
    
    /**
     * Get all of the posts for the country.
     */
    public function guardian()
    {
        return $this->hasManyThrough('App\Guardian', 'App\Child', 'has_been_pickup_by');
    }
    /**
     * Get the planned attendance associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child()
    {
        return $this->belongsTo('App\Models\Child', 'child_id');
    }

     /**
     * Get the planned attendance associated with the child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
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
                    ['in', '=', false],
                    ['out', '=', false]
                ]);
                break;
            case 'present_present':
                 $query->where([
                    ['in', '=', true],
                    ['out', '=', false]
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
    public function scopeGeneral($query, $conditions)
    {
        foreach($conditions as $column => $value)
        {
            $query->where($column, '=', $value);
            
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
        foreach($conditions as $column => $value)
        {
            if(is_array($value)){
                foreach($value as $val){
                    $query->orWhere($column, '=', $val);
                }
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
    public function scopeTest($query, $conditions)
    {
        foreach($conditions as $column => $value)
        {
            $query->whereHas('child', function ($sub) use($value){
                if(Count($value) > 1){
                    for($i = 0; Count($value) > $i ; $i++){
                        $val = $value[$i];
                        echo ' oh y ' . $val;
                        $max = Carbon::now()->subYear((int)$val)->format('Y');
                        $min = Carbon::now()->subYear(((int)$val) + 2)->format('Y');
                        $sub->orhere([
                            ['date_of_birth', '>', $min], 
                            ['date_of_birth', '<', $max], 
                        ]);
                    }
                } else {
                    echo 'oh no ' . $value[0];
                    $max = Carbon::now()->subYear((int)$value[0])->format('Y');
                    $min = Carbon::now()->subYear(((int)$value[0]) + 2)->format('Y');
                    $sub->where([
                       ['date_of_birth', '>', $min], 
                       ['date_of_birth', '<', $max], 
                   ]);
                }
            });
        }
    }

}
