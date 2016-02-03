<?php

namespace App\Models\Business\Store\Order;

trait OrderRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function shipping()
    {
        return $this->hasOne('App\Models\Business\Logistics\Shipping\Shipping');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function items()
    {
        return $this->hasMany('App\Models\Business\Store\Order\Item');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\Ticket\Ticket');
    }
}
