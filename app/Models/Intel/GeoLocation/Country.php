<?php

namespace App\Models\Intel\GeoLocation\Country;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_countries';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.countries_table');
    }

    /**
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\City');
    }

    /**
     */
    public function provinces()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Province');
    }
}
