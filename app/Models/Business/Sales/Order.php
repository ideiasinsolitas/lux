<?php

namespace App\Models\Business\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_orders';

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
    public function shipping()
    {
        return $this->hasOne('App\Models\Business\Logistics\Shipping');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function invoice()
    {
        return $this->belongsTo('App\Models\Business\Sales\Invoice');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function products()
    {
    }

    /**
     * /
     * @return [type] [description]
     */
    public function tickets()
    {
    }
}
