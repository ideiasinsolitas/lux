<?php

namespace App\Models\Business\Sales\Invoice;

trait InvoiceRelationship
{
    public function user()
    {
        return $this->morphedByMany('App\Models\Core\Access\User\User', 'ownership');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function customers()
    {
        return $this->morphMany('App\Models\Core\Access\User\User', 'collaboration');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function payment()
    {
        return $this->hasOne('App\Models\Business\Sales\Payment\Payment');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Business\Sales\Order\Order');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function shop()
    {
        return $this->belongsTo('App\Models\Business\Store\Shop\Shop');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Business\ProjectManagement\Project\Project');
    }
}
