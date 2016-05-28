<?php

namespace App\Listeners;

class LoggerListener
{
    public function handle($event)
    {
        $this->log($event);
    }
}
