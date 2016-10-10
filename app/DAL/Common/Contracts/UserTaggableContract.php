<?php

namespace App\DAL\Common\Contract;

interface UserTaggableContract
{
    const USER_TAGGABLE_TABLE = 'core_folksonomy';

    public function addFolksonomyTerm($user_id, $item_id, $term);

    public function addFolksonomyTerms($user_id, $item_id, array $terms);

    public function getAllFolksonomyTerms($item_id);

    public function getFolksonomyTermsByUser($user_id, $item_id);

    public function removeFolksonomyTerm($user_id, $item_id, $term);
}
