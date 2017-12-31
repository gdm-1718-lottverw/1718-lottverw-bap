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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'type', 'child_id', 'go_home_alone', 'parent_notes'];
    
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

}
