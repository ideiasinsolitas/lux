<?php

namespace App\Models\Intel\Subject\Person;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'intel_people';

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
