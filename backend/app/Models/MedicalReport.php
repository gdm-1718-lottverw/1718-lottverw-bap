<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_attention';
    protected $fillable = ['description', 'medication', 'prescription'];
    
}
