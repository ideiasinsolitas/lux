<?php

namespace App\Models\Business\Store\ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_carts';

    /**
     * The attributes that are not mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;
}
