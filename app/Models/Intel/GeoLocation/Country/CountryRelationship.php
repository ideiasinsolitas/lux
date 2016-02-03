<?php namespace App\Models\Intel\GeoLocation\Country\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait CountryRelationship
{

    /**
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\City\City');
    }

    /**
     */
    public function provinces()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Province\Province');
    }
}
