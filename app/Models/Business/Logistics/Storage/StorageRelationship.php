<?php

namespace App\Models\Business\Logistics\Storage;

trait StorageRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function shippings()
    {
        return $this->hasMany('App\Models\Business\Logistics\Shipping\Shipping');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function shops()
    {
        return $this->belongsToMany('App\Models\Business\Store\Shop\Shop');
    }
}
