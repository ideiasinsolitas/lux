<?php

namespace App\Models\Common;

trait Collector
{
    public function collections()
    {
        return $this->morphMany('App\Models\SiteBuilding\Collection', 'collector');
    }
}
