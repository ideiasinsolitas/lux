<?php

namespace App\Models\Intel\GeoLocation\Country;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\Country\CountryAttribute;
use App\Models\Intel\GeoLocation\Country\CountryRelationship;

// instance of Posts class will refer to posts table in database
class Country extends Model
{
    use CountryAttribute, CountryRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.countries_table');
    }
}
