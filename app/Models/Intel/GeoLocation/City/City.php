<?php

namespace App\Models\Intel\GeoLocation\City;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\City\CityAttribute;
use App\Models\Intel\GeoLocation\City\CityRelationship;

// instance of Posts class will refer to posts table in database
class City extends Model
{
    use CityAttribute, CityRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.cities_table');
    }
}
