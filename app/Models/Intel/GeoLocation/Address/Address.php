<?php

namespace App\Models\Intel\GeoLocation\Address;

use Illuminate\Database\Eloquent\Model;
use App\Models\Intel\GeoLocation\Address\AddressAttribute;
use App\Models\Intel\GeoLocation\Address\AddressRelationship;

// instance of Posts class will refer to posts table in database
class Address extends Model
{
    use AddressAttribute, AddressRelationship;

    protected $guarded = [];

    public $timestamps = false;

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('geolocation.addresses_table');
    }
}
