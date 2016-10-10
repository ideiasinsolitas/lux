<?php

namespace App\Listeners;

use App\Services\NotificationService;

class NotificationListener
{
    use App\Listeners\Common\Notifiable;

    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function handle($event)
    {
        $user = $event->getUser();
        return $this->notify($user->pk, $event->getNotification());
    }
}
