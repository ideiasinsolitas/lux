<?php

namespace App\Models\Intel\GeoLocation\Place;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    protected $guarded = [];

    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_places';

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.place_table');
    }

    /**
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Address');
    }
}
