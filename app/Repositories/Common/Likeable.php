<?php

namespace App\Repositories\Common;

trait Likeable
{
    public function buildLikeable($builder = null)
    {
        $builder = $builder || $this->getBuilder();
        $type = DB::raw($this->type);
        return $builder
            ->join('core_likes', function ($q) use ($type) {
                return $q->on('core_likes.likeable_id', 'main.id')
                    ->where('core_likes.likeable_type', $type);
            });
    }

    public function like($user_id, $item_id)
    {
        return DB::table('core_likes')
            ->insert(['user_id' => $user_id, 'item_id' => $item_id]);
    }

    public function unlike($user_id, $item_id)
    {
        return DB::table('core_likes')
            ->where('user_id', $user_id)
            ->where('likeable_type', $this->type)
            ->where('likeable_id', $item_id)
            ->delete();
    }

    public function getLikes($item_id)
    {
        return DB::table('core_likes')
            ->select(DB::raw('count(likeable_id) AS vote_count'))
            ->where('likeable_type', $this->type)
            ->where('likeable_id', $item_id)
            ->get();
    }
}
