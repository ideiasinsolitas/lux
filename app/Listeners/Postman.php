<?php

namespace App\Listeners;

class PostmanListener
{
    use App\Listeners\Common\Mailable;

    public function handle($event)
    {
        return $this->email($event);
    }
}
