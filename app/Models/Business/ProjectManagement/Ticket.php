<?php

namespace App\Models\Business\ProjectManagement\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\ProjectManagement\Ticket\TicketRelationship;

class Ticket extends Model
{
    use TicketRelationship;

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
        return $this->belongsTo('App\Models\Business\ProjectManagement\Project\Project');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Business\Sales\Order\Order');
    }

    public function times()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\TimeTracking\TimeTracking');
    }
}
