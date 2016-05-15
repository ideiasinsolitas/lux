<?php

namespace App\DAL\Relationships\Common;

trait Commentable
{
    public function addComment($item_id, $input)
    {
        $commentInput = [
            'node_id' => $input['node_id'],
            'parent_id' => $input['parent_id'],
            'user_id' => $input['user_id'],
            'created' => $input['created'],
            'modified' => $input['modified'],
            'deleted' => $input['deleted']
        ];

        $translationInput = ['body' => $input['body']];
        
        $commentingInput = [
            'user_id' => $input['user_id'],
            'commentable_type' => $input['commentable_type'],
            'commentable_id' => $input['commentable_id']
        ];

        $comment_id = DB::table('core_comments')->insertGetId($commentInput);
        if (!$comment_id) {
            throw new \Exception("Error Processing Request", 1);
        }

        $translationInput['translatable_type'] = 'Comment';
        $translationInput['translatable_id'] = $comment_id;
        $translation = DB::table('core_translations')->insert($translationInput);
        if (!$translation) {
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

    public function editComment($item_id, $input, $comment_id)
    {
        $translation = DB::table('core_translations')
            ->update(['body' => $input['body']])
            ->where('translatable_type', 'Comment')
            ->where('translatable_id', $comment_id)
            ->where('lang', $input['lang']);
        if (!$translation) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        return true;
    }

    public function getComments($item_id, $lang)
    {
        $translatable_type = DB::raw('\"Comment\"');
        return DB::table('core_comments')
            ->join('core_translations', function ($q) use ($translatable_type) {
                return $q->on('core_translations.translatable_type', $translatable_type)
                    ->where('core_translations.translatable_id', 'core_comments.id');
            })
            ->join('core_commenting', 'core_comments.id', 'core_commenting.comment_id')
            ->select()
            ->where('core_comments.id', $comment_id)
            ->where('core_translations.lang', $lang)
            ->get();
    }

    public function removeComment($comment_id)
    {
        $comment = DB::table('core_comments')
            ->where('id', $comment_id)
            ->delete();
        if (!$comment) {
            throw new \Exception("Error Processing Request", 1);
        }

        $translation = DB::table('core_translations')
            ->where('translatable_type', 'Comment')
            ->where('translatable_id', $comment_id)
            ->delete();
        if (!$translation) {
            throw new \Exception("Error Processing Request", 1);
        }

        return true;
    }
}
