<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allergies';

     /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllergie($query, $conditions)
    {
        foreach($conditions as $column => $value)
        {
            if(is_array($value)){
                 foreach($value as $val){
                    $query->orWhere('type', '=', $val);
                }
            }
           
        }
    }
}
