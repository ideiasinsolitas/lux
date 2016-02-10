<?php

namespace App\Models\Business\ProjectManagement\TimeTracking;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\ProjectManagement\TimeTracking\TimeTrackingRelationship;

class TimeTracking extends Model
{
    use TimeTrackingRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_time_tracking';
    
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
     */
    public function ticket()
    {
        return $this->belongsTo('App\Models\Project\Ticket\Ticket');
    }
}
