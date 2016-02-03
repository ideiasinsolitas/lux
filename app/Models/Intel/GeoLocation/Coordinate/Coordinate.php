<?php

namespace App\Models\Intel\GeoLocation\Coordinate;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\Coordinate\CoordinateAttribute;
use App\Models\Intel\GeoLocation\Coordinate\CoordinateRelationship;

// instance of Posts class will refer to posts table in database
class Coordinate extends Model
{
    use CoordinateAttribute, CoordinateRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.coordinates_table');
    }
}
