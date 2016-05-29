<?php

namespace App\Listeners;

class NotificationListener
{
    use Notifiable;

    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function handle($event)
    {
        $user = $event->getUser();
        return $this->notify($user->id, $event->getNotification());
    }
}
