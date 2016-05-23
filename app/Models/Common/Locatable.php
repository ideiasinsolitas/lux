<?php

namespace App\Models\Common;

trait Typed
{
    public function place()
    {
        return $this->belongsTo('App\Models\Intel\GeoLocation\Place');
    }
}
