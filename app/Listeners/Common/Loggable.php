<?php

namespace App\Listeners\Common;

trait Loggable
{
    public function log($event)
    {
        return \Log::$level($message);
    }
}
