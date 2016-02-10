<?php

namespace App\Models\Business\ProjectManagement;

use Illuminate\Database\Eloquent\Model;

class TimeTracking extends Model
{
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
        return $this->belongsTo('App\Models\Project\Ticket');
    }
}
