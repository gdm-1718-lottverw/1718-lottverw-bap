<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    protected $fillable = ['name', 'phone_number'];
    /**
     * Get the children associated with the doctor.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Models\Child', 'children_id');
    }
}
