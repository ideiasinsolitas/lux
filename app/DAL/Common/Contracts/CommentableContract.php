<?php

namespace App\DAL\Common\Contract;

interface CommentableContract
{
    public function addComment($item_id, array $input);

    public function editComment($item_id, array $input, $comment_id);

    public function getComments($item_id, $lang);

    public function removeComment($comment_id);
}
