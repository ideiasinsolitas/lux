<?php namespace App\Models\Intel\GeoLocation\Coordinate\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait CoordinateRelationship
{

    /**
     */
    public function addresses()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Address\Address');
    }
}
