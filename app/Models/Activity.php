 <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';
    /**
     * The acitvity that belong to the children.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany('App\Models\Child')->using('App\Models\ActivityChild');
    }

    /**
     * The acitvity that belong to the children.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
} 