<?php

namespace App\Repositories\Common;

trait Commentable
{
    public function handleCommentInput($input)
    {
        $commentInput = ['' => $input[''], '' => $input[''], '' => $input['']];
        $commentingInput = ['' => $input[''], '' => $input[''], '' => $input['']];
        return [$commentInput, $commentingInput];
    }

    public function addComment($input)
    {
        list($commentInput, $commentingInput) = $this->handleCommentInput($input);
        $commentingInput['comment_id'] = DB::table('comments')
            ->insertGetId($commentInput);
        return DB::table('commenting')
            ->insert($commentingInput);
    }

    public function getComments($item_id)
    {
        return DB::table('comments')
            ->join('commenting', 'comments.id', 'commenting.comment_id')
            ->select()
            ->where('id', $comment_id)
            ->get();
    }

    public function removeComment($comment_id)
    {
        return DB::table('comments')
            ->where('id', $comment_id)
            ->delete();
    }
}
