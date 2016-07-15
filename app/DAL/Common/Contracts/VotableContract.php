<?php

namespace App\DAL\Common\Contract;

interface VotableContract
{
    public function hasVoted($user_id, $item_id);

    public function vote($user_id, $item_id, $vote);

    public function unvote($user_id, $item_id);

    public function getVotes($item_id);
}
