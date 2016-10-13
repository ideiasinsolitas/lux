<?php

namespace App\DAL\Common\Relationships;

use Illuminate\Support\Facades\DB;

trait Commentable
{
    public function addComment($item_id, array $input)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $input['commentable_type'] = self::INTERNAL_TYPE;
        $input['Commentable_id'] = $item_id;
        return DB::table('core_comments')->insert($input);
    }

    public function editComment($item_id, array $input, $comment_id)
    {
        if (!is_int($item_id) || !is_int($comment_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $input['commentable_type'] = self::INTERNAL_TYPE;
        $input['Commentable_id'] = $item_id;
        return DB::table('core_comments')->where('id', $comment_id)->update($input);
    }

    public function getComments($item_id)
    {
        if (!intval($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_comments')
            ->select(
                'id',
                'parent_id',
                'user_id',
                'commentable_type',
                'commentable_id',
                'comment',
                'activity',
                'created',
                'modified',
                'deleted'
            )
            ->where('core_comments.commentable_id', $item_id)
            ->get();
    }

    public function removeComment($comment_id)
    {
        if (!is_int($comment_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $comment = DB::table('core_comments')
            ->where('id', $comment_id)
            ->delete();
        if (!$comment) {
            throw new \Exception("Error Processing Request", 1);
        }

        return true;
    }
}
