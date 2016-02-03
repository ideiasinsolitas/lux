<?php

namespace App\Models\Core\SiteBuilding\Menu;

trait MenuRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function links()
    {
        return $this->hasMany('App\Models\Publishing\Media\Link');
    }
}
