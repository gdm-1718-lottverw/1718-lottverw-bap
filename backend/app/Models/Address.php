<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{ 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';
 	
 	/**
     * Get the addresses for a given child.
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function parents()
    {
        return $this->hasMany('App\Models\Parents', 'address_id');
    }
}
