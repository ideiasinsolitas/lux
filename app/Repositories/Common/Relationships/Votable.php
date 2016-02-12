<?php

namespace App\Repositories\Relationships\Common;

trait Votable
{
    public function vote($user_id, $item_id, $vote)
    {
        $votable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_votes')
            ->insert([
                'user_id' => $user_id,
                'votable_type' => $votable_type,
                'votable_id' => $item_id,
                'vote' => $vote
            ]);
    }

    public function unvote($user_id, $item_id, $vote)
    {
        $votable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_votes')
            ->where('user_id', $user_id)
            ->where('votable_type', $votable_type)
            ->where('votable_id', $item_id)
            ->where('name', $vote)
            ->delete();
    }

    public function getVotes($item_id)
    {
        $votable_type = DB::raw('\"' . $this->type . '\"');
        return DB::raw('core_votes')
            ->select('vote', DB::raw('count(vote) AS vote_count'))
            ->groupBy('vote')
            ->where('votable_type', $votable_type)
            ->where('votable_id', $item_id)
            ->get();
    }
}
