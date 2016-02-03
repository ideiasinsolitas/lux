<?php

namespace App\Models\Business\Sales\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\Sales\Payment\PaymentRelationship;

class Payment extends Model
{
    use SoftDeletes,
        PaymentRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_payments';

    /**
     * For soft deletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are not mass assignable.
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    // public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     * @var string
     */
    // protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    // protected $fillable = [];

    /**
     * The connection name for the model.
     *
     * @var string
     */
    // protected $connection = 'connection-name';
}
