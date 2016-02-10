<?php

namespace App\Models\Publishing\ContentManagement;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
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

    public function issues()
    {
        $this->hasMany('App\Models\ContentManagement\Issue');
    }

    public function publisher()
    {
        $this->belongTo('App\Models\ContentManagement\Publisher');
    }
}
