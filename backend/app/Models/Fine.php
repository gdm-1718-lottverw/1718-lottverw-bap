<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fines';
    
    /**
     * Get the payment for a given fine
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
