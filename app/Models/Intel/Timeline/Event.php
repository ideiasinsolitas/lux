<?php

namespace App\Models\Intel\Timeline;

use Illuminate\Database\Eloquent\Model;

use App\Models\Common\Typed;
use App\Models\Common\Locatable;

class Event extends Model
{
    use Typed, Locatable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_events';

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

    /**
     * /
     * @return [type] [description]
     */
    public function calendar()
    {
        return $this->belongsTo('App\Models\Intel\Timeline\Calendar');
    }
}
