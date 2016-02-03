<?php namespace App\Models\Intel\GeoLocation\District\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait DistrictRelationship
{

    /**
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Address\Address');
    }

    /**
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\City\City');
    }
}
