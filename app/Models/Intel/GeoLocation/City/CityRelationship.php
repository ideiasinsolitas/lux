<?php namespace App\Models\Intel\GeoLocation\City\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait CityRelationship
{

    /**
     */
    public function district()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\District\District');
    }

    /**
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Address\Address');
    }

    /**
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Province\Province');
    }

    /**
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Country\Country');
    }
}
