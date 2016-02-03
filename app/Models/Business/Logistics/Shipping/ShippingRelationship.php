<?php

namespace App\Models\Business\Logistics\Shipping;

trait ShippingRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function storage()
    {
        return $this->belongsTo('App\Models\Business\Logistics\Storage\Storage');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Business\Store\Order\Order');

    }
}
