<?php

namespace App\Models\Common;

trait Collectable
{
    /**
     * Get all of the product's likes.
     */
    public function collections()
    {
        return $this->morphToMany('App\Models\Core\SiteBuilding\Collection', 'collectable');
    }
}
