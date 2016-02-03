<?php

namespace App\Models\Package\Translation;

trait TranslationRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function this()
    {
        return $this->hasOne('App\Models\Package\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function that()
    {
        return $this->belongsTo('App\Models\Package\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function these()
    {
        return $this->hasMany('App\Models\Package\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function those()
    {
        return $this->belongsToMany('App\Models\Package\Name\Name');
    }
}
