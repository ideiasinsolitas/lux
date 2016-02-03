<?php

namespace App\Models\Core\SiteBuilding\Block;

trait BlockRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Core\SiteBuilding\Area\Area');
    }
}
