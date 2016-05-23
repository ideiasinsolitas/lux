<?php

namespace App\Models\Core\Interaction\Vote;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_votes';

    /**
     * The attributes that are not mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;
    
    public function votable()
    {
        return $this->morphTo();
    }
}
