<?php

namespace App\Models\Intel\GeoLocation\City;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_cities';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.cities_table');
    }

    /**
     */
    public function district()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\District');
    }

    /**
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Address');
    }

    /**
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Province');
    }

    /**
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Country');
    }
}
