<?php

namespace App\Models\Core\Sys;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_resources';

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

    public function menu()
    {
        $this->belongsTo('App\Models\Core\SiteBuilding\Menu');
    }
}
