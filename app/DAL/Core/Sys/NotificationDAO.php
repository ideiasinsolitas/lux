<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use Illuminate\Support\DB;
use App\DAL\Core\Sys\Contracts\NotificationDAOContract;

class NotificationDAO implements NotificationDAOContract
{
    use DAOTrait;
    
    public function insert(array $item)
    {
        return DB::table(self::TABLE)
            ->insert($item);
    }

    public function getAll(array $filters)
    {
        return DB::table(self::TABLE)
            ->take($filters['limit'])
            ->get();
    }

    public function getUnseen(array $filters)
    {
        return DB::table(self::TABLE)
            ->where('seen', null)
            ->get();
    }

    public function markAsSeen($user_id, $notification_id, $datetime)
    {
        if (!is_int($user_id) || !is_int($notification_id) || !is_string($datetime)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->where(self::TABLE . '.user_id', $user_id)
            ->where(self::TABLE . '.notification_id', $notification_id)
            ->update(['seen' => $datetime]);

    }

    public function markAllAsSeen($user_id, $datetime)
    {
        if (!is_int($user_id) || !is_string($datetime)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->where(self::TABLE . '.user_id', $user_id)
            ->update(['seen' => $datetime]);
    }
}
