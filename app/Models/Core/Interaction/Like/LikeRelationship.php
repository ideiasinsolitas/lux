<?php

namespace App\Models\Core\Interaction\Like;

trait LikeRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function this()
    {
        return $this->hasOne('App\Models\Core\Interaction\Like\Like');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function that()
    {
        return $this->belongsTo('App\Models\Core\Interaction\Like\Like');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function these()
    {
        return $this->hasMany('App\Models\Core\Interaction\Like\Like');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function those()
    {
        return $this->belongsToMany('App\Models\Core\Interaction\Like\Like');
    }
}
