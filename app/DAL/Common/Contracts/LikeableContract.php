<?php

namespace App\DAL\Common\Contract;

interface LikeableContract
{
    const LIKE_TABLE = 'core_like';

    const LIKE_PK = 'id';

    public function like($user_id, $item_id);

    public function unlike($user_id, $item_id);

    public function getLikes($item_id);
}
