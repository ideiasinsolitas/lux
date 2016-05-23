<?php

namespace App\Models\Business\Store;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_shops';

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
    public function products()
    {
        return $this->hasMany('App\Models\Business\Store\Product');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function storages()
    {
        return $this->belongsToMany('App\Models\Business\Logistics\Storage');
    }
}
