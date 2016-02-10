<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_payments';

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
    public function invoice()
    {
        return $this->belongsTo('App\Models\Business\Sales\Invoice');
    }
}
