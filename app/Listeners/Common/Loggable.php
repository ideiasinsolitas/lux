<?php

namespace App\Listeners\Common;

trait Loggable
{
    public function log($event)
    {
        $level = $event->getLevel();
        $message = $event->getMessage();
        return \Log::$level($message);
    }
}
