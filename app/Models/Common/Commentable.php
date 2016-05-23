<?php

namespace App\Models\Common;

trait Commentable
{
    public function comments()
    {
        return $this->morphToMany('App\Models\Core\Interaction\Comment', 'commentable');
    }
}
