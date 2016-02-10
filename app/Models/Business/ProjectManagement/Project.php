<?php

namespace App\Models\Business\ProjectManagement\Project;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_projects';

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
    public function tickets()
    {
        return $this->hasMany('App\Models\Business\ProjectManagement\Ticket\Ticket');
    }
}
