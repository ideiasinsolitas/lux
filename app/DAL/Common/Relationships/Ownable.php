<?php

namespace App\DAL\Relationships\Common;

use Illuminate\Support\Facades\DB;

trait Ownable
{
    public function own($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_ownership')
            ->insertGetId([
                'user_id' => $user_id,
                'ownable_type' => self::INTERNAL_TYPE,
                'ownable_id' => $item_id
            ]);
    }

    public function changeOwner($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_ownership')
            ->where('ownable_type', self::INTERNAL_TYPE)
            ->where('ownable_id', $item_id)
            ->update(['user_id' => $user_id]);
    }

    public function getOwner($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $ownable_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table('core_users')
            ->join('core_ownership', function ($q) use ($item_id, $ownable_type) {
                return $q->on('core_ownership.ownable_type', $ownable_type)
                    ->where('core_ownership.ownable_id', $item_id);
            })
            ->join('core_ownership', 'core_users.id', 'core_ownership.user_id')
            ->select('core_users.id', 'core_users.first_name', 'core_users.middle_name', 'core_users.last_name')
            ->get()
            ->first();
    }

    public function isOwner($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_ownership')
            ->select('user_id')
            ->where('user_id', $user_id)
            ->where('ownable_type', self::INTERNAL_TYPE)
            ->where('ownable_id', $item_id)
            ->get() ? true : false;
    }
}
