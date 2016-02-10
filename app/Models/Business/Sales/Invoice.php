<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_invoices';

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

    public function user()
    {
        return $this->morphedByMany('App\Models\Core\Access\User\User', 'ownership');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function customers()
    {
        return $this->morphMany('App\Models\Core\Access\User\User', 'collaborative');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function payment()
    {
        return $this->hasOne('App\Models\Business\Sales\Payment');
    }
    
    /**
     * /
     * @return [type] [description]
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Business\Sales\Order');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function shop()
    {
        return $this->belongsTo('App\Models\Business\Store\Shop');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Business\ProjectManagement\Project');
    }
}
