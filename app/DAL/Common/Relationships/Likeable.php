<?php

namespace App\DAL\Relationships\Common;

trait Likeable
{
    public function like($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_likes')
            ->insert([
                'user_id' => $user_id,
                'likeable_type' => self::INTERNAL_TYPE,
                'likeable_id' => $item_id
            ]);
    }

    public function unlike($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_likes')
            ->where('user_id', $user_id)
            ->where('likeable_type', self::INTERNAL_TYPE)
            ->where('likeable_id', $item_id)
            ->delete();
    }

    public function getLikes($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_likes')
            ->select(DB::raw('count(likeable_id) AS vote_count'))
            ->where('likeable_type', self::INTERNAL_TYPE)
            ->where('likeable_id', $item_id)
            ->get();
    }
}
