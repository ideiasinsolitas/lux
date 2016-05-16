<?php

namespace App\Events\Common;

use App\Services\Sys\NotificationService;

trait Notifiable
{
    public function sendNotification($user_id, $notification)
    {
        $this->notificationService->notify($user_id, $notification);
    }
}
