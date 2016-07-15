<?php

namespace App\DAL\Common\Contract;

interface TypeAwareContract
{
    const TYPE_FK = 'type_id';

    public function addFolksonomyTerm($user_id, $item_id, $term);

    public function addFolksonomyTerms($user_id, $item_id, array $terms);

    public function getAllFolksonomyTerms($item_id);

    public function getFolksonomyTermsByUser($user_id, $item_id);

    public function removeFolksonomyTerm($user_id, $item_id, $term);
}
