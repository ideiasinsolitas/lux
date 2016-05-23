<?php

namespace App\Models\Business\Logistics;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_storages';

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

    /**
     * /
     * @return [type] [description]
     */
    public function shippings()
    {
        return $this->hasMany('App\Models\Business\Logistics\Shipping\Shipping');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function shops()
    {
        return $this->belongsToMany('App\Models\Business\Store\Shop\Shop');
    }
}
