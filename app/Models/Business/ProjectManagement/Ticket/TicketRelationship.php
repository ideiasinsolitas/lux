<?php namespace App\Models\Business\ProjectManagement\Ticket;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait TicketRelationship
{
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
