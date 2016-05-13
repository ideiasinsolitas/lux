<?php

namespace App\Models\Relationships\Common;

trait Commentable
{
    public function handleCommentInput($input)
    {
        $commentInput = ['' => $input[''], '' => $input[''], '' => $input['']];
        $commentingInput = ['' => $input[''], '' => $input[''], '' => $input['']];
        return [$commentInput, $commentingInput];
    }

    public function addComment($item_id, $input)
    {
        list($commentInput, $commentingInput) = $this->handleCommentInput($input);
        $commentingInput['comment_id'] = DB::table('comments')
            ->insertGetId($commentInput);
        $commentingInput['commentable_type'] = DB::raw('\"' . $this->type . '\"');
        $commentingInput['commentable_id'] = $item_id;
        return DB::table('commenting')
            ->insert($commentingInput);
    }

    public function getComments($item_id, $lang)
    {
        return DB::table('core_comments')
            ->join('core_commenting', 'core_comments.id', 'core_commenting.comment_id')
            ->select()
            ->where('core_comments.id', $comment_id)
            ->where('core_comments.lang', $lang)
            ->get();
    }

    public function removeComment($comment_id)
    {
        return DB::table('comments')
            ->where('id', $comment_id)
            ->delete();
    }
}
