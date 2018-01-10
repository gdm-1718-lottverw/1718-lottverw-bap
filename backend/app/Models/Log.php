<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * Get the parents for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->belongsTo('App\Models\Children');
    }

    /**
     * Get the children associated with the doctor.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->belongsTo('App\Models\Action', 'action_id');
    }

    /**
     * Scope a query to only include logs with some conditions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGeneral($query, $conditions)
    { 

        $query = $query
        ->join('children As child', 'child.id', '=', 'logs.child_id');
        foreach($conditions as $column => $value){
            $query->where([
                ['logs.'.$column, '=', $value],
            ]);
        }
    }

    /**
     * Scope a query to only include logs with some conditions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActionName($query)
    {
        $query= $query->join('actions', 'actions.id', '=', 'logs.action_id')->get();
    }
}
