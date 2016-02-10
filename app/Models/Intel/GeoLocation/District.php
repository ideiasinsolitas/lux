<?php

namespace App\Models\Intel\GeoLocation\District;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_districts';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.districts_table');
    }

    /**
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\Address\Address');
    }

    /**
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\City\City');
    }
}
