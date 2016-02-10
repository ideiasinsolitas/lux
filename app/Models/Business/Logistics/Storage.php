<?php

namespace App\Models\Business\Logistics\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\Logistics\Storage\StorageRelationship;

class Storage extends Model
{
    use StorageRelationship;

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
