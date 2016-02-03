<?php

namespace App\Models\Intel\Subject\Vehicle;

trait VehicleRelationship
{
    /**
     * /
     * @return [type] [description]
     */
    public function this()
    {
        return $this->hasOne('App\Models\Intel\Subject\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function that()
    {
        return $this->belongsTo('App\Models\Intel\Subject\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function these()
    {
        return $this->hasMany('App\Models\Intel\Subject\Name\Name');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function those()
    {
        return $this->belongsToMany('App\Models\Intel\Subject\Name\Name');
    }
}
