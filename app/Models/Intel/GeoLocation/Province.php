<?php

namespace App\Models\Intel\GeoLocation\Province;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_provinces';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.provinces_table');
    }

    /**
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Intel\GeoLocation\City\City');
    }

    /**
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Country\Country');
    }
}
