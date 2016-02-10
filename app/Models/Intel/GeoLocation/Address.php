<?php

namespace App\Models\Intel\GeoLocation\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_addresses';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.addresses_table');
    }
    
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
