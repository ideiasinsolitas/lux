<?php

namespace App\DAL\Common\Contract;

interface LikeableContract
{
    public function like($user_id, $item_id);

    public function unlike($user_id, $item_id);

    public function getLikes($item_id);
}
