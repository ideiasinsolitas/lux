<?php

namespace App\Listeners\Common;

use App\Services\Sys\NotificationService;

trait Notifiable
{
    public function notify($event)
    {
        return $this->notificationService->send($event->getUser()->id, $event->getNotification());
    }
}
