<?php

namespace App\Models\Business\Logistics\Shipping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\Logistics\Shipping\ShippingRelationship;

class Shipping extends Model
{
    use ShippingRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_shippings';

    /**
     * For soft deletes
     * @var array
     */
    protected $dates = ['deleted_at'];

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
    public function storage()
    {
        return $this->belongsTo('App\Models\Business\Logistics\Storage\Storage');
    }
}
