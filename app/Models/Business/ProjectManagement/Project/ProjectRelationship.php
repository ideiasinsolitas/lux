<?php

namespace App\Models\Business\ProjectManagement\Project;

trait ProjectRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\Ticket\Ticket');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\Invoice\Invoice');
    }
}
