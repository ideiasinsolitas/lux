<?php

namespace App\Core\Interaction\Contracts;

interface HasCommentsContract
{
    public function getComments($item_id);
}
