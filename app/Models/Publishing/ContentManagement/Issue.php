<?php

namespace App\Models\Publishing\ContentManagement;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
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

    public function contents()
    {
        $this->hasMany('App\Models\Publishing\ContentManagement\Content');
    }

    public function publication()
    {
        $this->belongTo('App\Models\Publishing\ContentManagement\Publication');
    }
}
