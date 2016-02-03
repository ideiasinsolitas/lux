<?php

namespace App\Models\Publishing\Media\Link;

trait LinkRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function this()
    {
        return $this->hasOne('App\Models\Publishing\Media\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function that()
    {
        return $this->belongsTo('App\Models\Publishing\Media\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function these()
    {
        return $this->hasMany('App\Models\Publishing\Media\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function those()
    {
        return $this->belongsToMany('App\Models\Publishing\Media\Name\Name');
    }
}
