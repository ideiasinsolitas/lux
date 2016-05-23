<?php

namespace App\Models\Core\SiteBuilding;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_areas';

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
     */
    public function blocks()
    {
        return $this->hasMany('App\Models\SiteBuilding\Block');
    }
}
