<?php

namespace App\Models\Business\Logistics;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
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
