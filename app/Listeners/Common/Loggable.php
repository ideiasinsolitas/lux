<?php

namespace App\Listeners\Common;

use Log;

trait Loggable
{
    public function log($level, $message)
    {
        Log::$level($message);
    }
}
