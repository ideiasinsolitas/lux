<?php

namespace App\Repositories\Common;

trait Votable
{
    public function vote($user_id, $item_id, $vote)
    {
        return DB::table('core_votes')
            ->insert([
                'user_id' => $user_id,
                'votable_type' => $this->type,
                'votable_id' => $item_id,
                'vote' => $vote
            ]);
    }

    public function unvote($user_id, $item_id, $vote)
    {
        return DB::table('core_votes')
            ->where('user_id', $user_id)
            ->where('votable_type', $this->type)
            ->where('votable_id', $item_id)
            ->where('name', $vote)
            ->delete();
    }

    public function getVotes($item_id)
    {
        return DB::raw('core_votes')
            ->select('vote', DB::raw('count(vote) AS vote_count'))
            ->groupBy('vote')
            ->where('votable_type', $this->type)
            ->where('votable_id', $item_id)
            ->get();
    }
}
