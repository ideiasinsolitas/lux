<?php

namespace App\Models\Business\Sales\Payment;

trait PaymentRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function invoice()
    {
        return $this->belongsTo('App\Models\Business\Sales\Invoice\Invoice');
    }
}
