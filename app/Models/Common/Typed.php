<?php

namespace App\Models\Common;

trait Typed
{
    public function type()
    {
        $this->belongsTo('App\Models\Core\Sys\Type');
    }
}
