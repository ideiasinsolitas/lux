<?php

namespace App\Models\Intel\GeoLocation\Province;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\Province\ProvinceAttribute;
use App\Models\Intel\GeoLocation\Province\ProvinceRelationship;

// instance of Posts class will refer to posts table in database
class Province extends Model
{
    use ProvinceAttribute, ProvinceRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.provinces_table');
    }
}
