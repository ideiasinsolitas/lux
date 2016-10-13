<?php

namespace App\DAL\Common\Contract;

interface OwnableContract
{
    public function own($user_id, $item_id);

    public function changeOwner($user_id, $item_id);

    public function getOwner($item_id);

    public function isOwner($user_id, $item_id);
}
