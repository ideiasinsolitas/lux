<?php

namespace App\Models\Business\Store\Order;

trait ItemRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Business\Store\Order\Order');
    }
}
