<?php

namespace App\Models\Publishing\Taxonomy\Term;

trait TermRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function this()
    {
        return $this->hasOne('App\Models\Publishing\Taxonomy\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function that()
    {
        return $this->belongsTo('App\Models\Publishing\Taxonomy\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function these()
    {
        return $this->hasMany('App\Models\Publishing\Taxonomy\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function those()
    {
        return $this->belongsToMany('App\Models\Publishing\Taxonomy\Name\Name');
    }
}
