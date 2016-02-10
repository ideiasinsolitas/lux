<?php

namespace App\Models\Core\SiteBuilding\Block;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Package\Block\Relationship\BlockRelationship;

class Block extends Model
{
    use BlockRelationship;

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
