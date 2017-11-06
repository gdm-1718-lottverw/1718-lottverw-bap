<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function Organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

     /**
     * The acitvity that belong to the children.
     */
    public function children()
    {
        return $this->belongsToMany('App\Models\Child');
    }

}
