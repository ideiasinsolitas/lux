<?php

namespace App\Models\Common;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany('App\Models\Interaction\Like', 'likeable');
    }
}
