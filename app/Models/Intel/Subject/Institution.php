<?php

namespace App\Models\Intel\Subject\Institution;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_institutions';

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
