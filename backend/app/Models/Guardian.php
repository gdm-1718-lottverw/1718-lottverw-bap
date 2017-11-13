<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guardians';
    
    /**
     * The children that belong a given guardian.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany('App\Models\Child');
    }
}
