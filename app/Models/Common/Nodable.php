<?php

namespace App\Models\Common;

trait Nodable
{
    public function node()
    {
        $this->belongsTo('App\Models\Core\SiteBuilding\Node');
    }
}
