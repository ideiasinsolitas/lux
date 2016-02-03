<?php

namespace App\Models\Intel\GeoLocation\District;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\District\DistrictAttribute;
use App\Models\Intel\GeoLocation\District\DistrictRelationship;

// instance of Posts class will refer to posts table in database
class District extends Model
{
    use DistrictAttribute, DistrictRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.districts_table');
    }
}
