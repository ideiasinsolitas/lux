<?php namespace App\Models\Intel\GeoLocation\Address;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait AddressRelationship
{
    /**
     */
    public function coordinate()
    {
        return $this->hasOne('App\Models\Intel\GeoLocation\Coordinate\Coordinate');
    }

    /**
     */
    public function places()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Place\Place');
    }

    /**
     */
    public function district()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\District\District');
    }

    /**
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\City\City');
    }
}
