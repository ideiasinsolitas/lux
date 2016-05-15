<?php

namespace App\DAL\Relationships\Common;

trait Votable
{
    public function hasVoted($user_id, $item_id)
    {
        return DB::table('core_votes')
            ->where('user_id', $user_id)
            ->where('votable_type', self::INTERNAL_TYPE)
            ->where('votable_id', $item_id)
            ->first();
    }

    public function vote($user_id, $item_id, $vote)
    {
        return DB::table('core_votes')
            ->insert([
                'user_id' => $user_id,
                'votable_type' => self::INTERNAL_TYPE,
                'votable_id' => $item_id,
                'name' => $vote
            ]);
    }

    public function unvote($user_id, $item_id)
    {
        return DB::table('core_votes')
            ->where('user_id', $user_id)
            ->where('votable_type', self::INTERNAL_TYPE)
            ->where('votable_id', $item_id)
            ->delete();
    }

    public function getVotes($item_id)
    {
        return DB::raw('core_votes')
            ->select('name', DB::raw('count(name) AS vote_count'))
            ->groupBy('name')
            ->where('votable_type', self::INTERNAL_TYPE)
            ->where('votable_id', $item_id)
            ->get();
    }
}
