<?php

namespace App\Services\Sys;

use App\DAL\Core\Sys\NotificationDAO;
use Carbon\Carbon;

class NotificationService
{
    protected $dao;

    public function __construct(NotificationDAO $dao)
    {
        $this->dao = $dao;
    }

    public function notify($user_id, $notification)
    {
        if (!is_int($user_id) && !is_string($notification)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $notification = ['user_id' => $user_id, 'notification' => $notification, 'created' => Carbon::now()];
        $result = $this->dao->insert($notification);
        if (!$result) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $result;
    }
}
