<?php

namespace App\Models\Core\Interaction;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'core_friendships';

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
