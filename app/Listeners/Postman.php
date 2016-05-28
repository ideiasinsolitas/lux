<?php

namespace App\Listeners;

class PostmanListener
{
    use Mailable;

    public function handle($event)
    {
        return $this->send($event);
    }
}
