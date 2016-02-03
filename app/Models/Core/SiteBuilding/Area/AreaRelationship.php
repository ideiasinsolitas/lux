<?php namespace App\Models\SiteBuilding\Area;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait AreaRelationship
{
    /**
     */
    public function blocks()
    {
        return $this->hasMany('App\Models\SiteBuilding\Block\Block');
    }
}
