<?php

namespace App\Models\Core\SiteBuilding;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_menus';

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
    public function links()
    {
        return $this->hasMany('App\Models\Core\Sys\Resource');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function blocks()
    {
        return $this->hasMany('App\Models\Core\SiteBuilding\Block');
    }
}
