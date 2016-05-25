<?php

namespace App\DAL\Core\Interaction\Contracts;

interface CommentDAOContract
{
    const TABLE = "core_comments";

    const PK = "id";

    const INTERNAL_TYPE = "Comment";

    public function createNode();

    public function insert(array $input);

    public function update(array $input, $pk);

    public function addTranslation($item_id, $lang, array $input);

    public function updateTranslation($item_id, $lang, array $input);

    public function getAllTranslations($item_id);

    public function getTranslation($item_id, $lang);

    public function getSlug($item_id, $lang);

    public function getTranslationBySlug($slug);

    public function removeTranslation($item_id, $lang);

    public function generateSlug($string);

    public function slugExists($slug);

    public function delete($pk);

    public function deleteMany(array $pks);

    public function getOne(array $filters);

    public function getAll(array $filters = array());

    public function own($user_id, $item_id);

    public function changeOwner($user_id, $item_id);

    public function getOwner($item_id);

    public function isOwner($user_id, $item_id);

    public function generateTree(array $items);

    public function buildTree($branch_id = 0);

    public function setBranch($leaf_id, $branch_id = 0);

    public function getBranch($leaf_id);

    public function getLeaves($branch_id);

    public function addLeaf($branch_id, $leaf_id);

    public function addLeaves($branch_id, array $leaves_id);

    public function removeLeaf($leaf_id);
}
