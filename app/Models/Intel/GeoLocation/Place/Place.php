<?php

namespace App\Models\Intel\GeoLocation\Place;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\Place\PlaceAttribute;
use App\Models\Intel\GeoLocation\Place\PlaceRelationship;

// instance of Posts class will refer to posts table in database
class Place extends Model
{
    use PlaceAttribute, PlaceRelationship;
    
    protected $guarded = [];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.place_table');
    }
}
