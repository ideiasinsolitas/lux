<?php

namespace App\Listeners;

class LoggerListener
{
    use App\Listeners\Common\Loggable;

    public function handle($event)
    {
        $this->log($event);
    }
}
