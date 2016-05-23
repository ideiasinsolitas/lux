<?php

namespace App\Models\Core\Taxonomy;

use Illuminate\Database\Eloquent\Model;

class Folksonomy extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'names';

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
