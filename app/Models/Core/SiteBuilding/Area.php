<?php

namespace App\Models\Core\SiteBuilding\Area;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Package\Area\Relationship\AreaRelationship;

class Area extends Model
{
    use AreaRelationship;

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
