<?php

namespace App\Models\Business\Store\Shop;

trait ShopRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function storages()
    {
        return $this->belongsToMany('App\Models\Business\Logistics\Storage\Storage');
    }
}
