<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDAO;

use App\DAL\Core\Sys\Contracts\NotificationDAOContract;

class NotificationDAO implements NotificationDAOContract
{
    public function insert(array $item)
    {
        
    }

    public function getAll(array $filters)
    {

    }

    public function markAsSeen($user_id, $datetime)
    {
        if (!is_int($user_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

    }

    public function markAllAsSeen($user_id, $datetime)
    {
        if (!is_int($user_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->where();
    }
}
