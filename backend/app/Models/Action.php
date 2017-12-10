<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
     /**
     * Get the parents for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logs()
    {
        return $this->belongsTo('App\Models\Log');
    }
}
