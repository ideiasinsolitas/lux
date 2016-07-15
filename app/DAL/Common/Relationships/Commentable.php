<?php

namespace App\DAL\Common\Relationships;

trait Commentable
{
    public function addComment($item_id, array $input)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $commentInput = [
            'node_id' => $input['node_id'],
            'parent_id' => $input['parent_id'],
            'user_id' => $input['user_id'],
            'body' => $input['body'],
            'created' => $input['created'],
            'modified' => $input['modified'],
            'deleted' => $input['deleted']
        ];

        $commentingInput = [
            'user_id' => $input['user_id'],
            'commentable_type' => $input['commentable_type'],
            'commentable_id' => $input['commentable_id']
        ];

        $comment_id = DB::table('core_comments')->insertGetId($commentInput);
        if (!$comment_id) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $commentingInput['comment_id'] = $comment_id;
        $commentingInput['commentable_type'] = self::INTERNAL_TYPE;
        $commentingInput['commentable_id'] = $item_id;
        $commenting = DB::table('core_commenting')->insert($commentingInput);
        if (!$commenting) {
            throw new \Exception("Error Processing Request", 1);
        }

        return true;
    }

    public function editComment($item_id, array $input, $comment_id)
    {
        if (!is_int($item_id) || !is_int($comment_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

    }

    public function getComments($item_id, $lang)
    {
        if (!is_int($item_id) || !is_string($lang)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $translatable_type = DB::raw('\"Comment\"');
        return DB::table('core_comments')
            ->join('core_commenting', 'core_comments.id', 'core_commenting.comment_id')
            ->select(
                '',
                ''
            )
            ->where('core_comments.id', $comment_id)
            ->where('core_translations.lang', $lang)
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
