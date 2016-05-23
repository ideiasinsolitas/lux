<?php

namespace App\Models\Core\SiteBuilding;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_blocks';

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
    public function area()
    {
        return $this->belongsTo('App\Models\Core\SiteBuilding\Area');
    }
}
