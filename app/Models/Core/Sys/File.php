<?php

namespace App\Models\Core\Sys;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use Nodable, Ownable, Activity, Builder, OwnerTaggable;
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_files';

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
