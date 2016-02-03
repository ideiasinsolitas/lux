<?php namespace App\Models\Business\ProjectManagement\TimeTracking;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait TimeTrackingRelationship
{
    /**
     */
    public function ticket()
    {
        return $this->belongsTo('App\Models\Project\Ticket\Ticket');
    }
}
