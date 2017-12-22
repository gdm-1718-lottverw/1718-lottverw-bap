<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function scopePresent($query, $date, $or_id, $presence)
    {
        switch($presence){
            case 'future':
                return $query->where([
                    ['date','=', $date], 
                    ['organization_id', '=', $or_id], 
                    ['in', '=', false],
                    ['out', '=', false]
                ]);
            case 'in':
                return $query->where([
                    ['date','=', $date], 
                    ['organization_id', '=', $or_id], 
                    ['in', '=', true],
                    ['out', '=', false]
                ]);
            case 'out': 
                return $query->where([
                    ['date','=', $date], 
                    ['organization_id', '=', $or_id], 
                    ['in', '=', true],
                    ['out', '=', true]
                ]);
            break;
            default:
                return $query->where([
                    ['date','=', $date], 
                    ['organization_id', '=', $or_id], 
                ]);
                break;
        }
        
    }
}
