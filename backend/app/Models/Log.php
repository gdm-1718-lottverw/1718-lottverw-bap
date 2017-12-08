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
}
