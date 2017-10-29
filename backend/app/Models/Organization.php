<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Organization extends Model
{
    protected $fillable = array('name');
  
   /**
    * Get the phone record associated with the user.
    */
    public function mainOrganization()
    {
        return $this->hasOne('App\Models\Organization', 'main_organization_id', 'id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function authKey()
    {
        return $this->hasOne('App\Models\AuthKey');
    }


}
