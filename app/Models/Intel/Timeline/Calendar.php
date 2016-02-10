<?php

namespace App\Models\Intel\Timeline;

use Illuminate\Database\Eloquent\Model;

use App\Models\Common\Nodable;
use App\Models\Common\Ownable;

class Calendar extends Model
{
    use Nodable, Ownable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_calendars';

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
    public function events()
    {
        return $this->hasMany('App\Models\Intel\Timeline\Event');
    }
}
