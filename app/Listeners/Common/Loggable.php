<?php

namespace App\Listeners\Common;

trait Loggable
{
    public function log($level, $message)
    {
        \Log::$level($message);
    }
}
