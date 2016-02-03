<?php namespace App\Models\Intel\GeoLocation\Province\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait ProvinceRelationship
{

    /**
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\City\City');
    }

    /**
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Country\Country');
    }
}
