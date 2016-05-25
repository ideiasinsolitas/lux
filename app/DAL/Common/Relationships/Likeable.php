<?php

namespace App\DAL\Common\Relationships;

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
            ->where('core_likes.user_id', $user_id)
            ->where('core_likes.likeable_type', self::INTERNAL_TYPE)
            ->where('core_likes.likeable_id', $item_id)
            ->delete();
    }

    public function getLikes($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_likes')
            ->select(DB::raw('count(core_likes.likeable_id) AS like_count'))
            ->where('core_likes.likeable_type', self::INTERNAL_TYPE)
            ->where('core_likes.likeable_id', $item_id)
            ->get();
    }
}
