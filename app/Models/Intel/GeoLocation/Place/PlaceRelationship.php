<?php namespace App\Models\Intel\GeoLocation\Place\Traits;

/**
 * Class PermissionAttribute
 * @package App\Models\Access\Permission\Attribute
 */
trait PlaceRelationship
{

    /**
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    /**
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Address\Address');
    }
}
