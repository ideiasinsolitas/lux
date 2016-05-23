<?php

namespace App\Models\Business\ProjectManagement;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_tickets';

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

    public function user()
    {
        return $this->belongsTo('App\Models\Core\Access\User\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Business\ProjectManagement\Project');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Business\Sales\Order');
    }

    public function times()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\TimeTracking');
    }
}
