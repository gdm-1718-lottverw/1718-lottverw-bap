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
    protected $fillable = ['type', 'gravity', 'description', 'medication', 'prescription'];
}
