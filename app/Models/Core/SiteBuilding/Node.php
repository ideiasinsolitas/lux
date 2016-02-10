<?php

namespace App\Models\Core\SiteBuilding;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'publishing_nodes';

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
}
