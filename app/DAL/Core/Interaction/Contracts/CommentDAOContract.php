<?php

namespace App\DAL\Core\Interaction\Contracts;

interface CommentDAOContract
{
    const TABLE = "core_comments";

    const PK = "id";

    const INTERNAL_TYPE = "Comment";

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    public function deleteMany(array $pks);

    // DefaultSelector
    public function getOne(array $filters);

    public function getAll(array $filters = array());

    // Nodable
    public function createNode();

    // Ownable
    public function own($user_id, $item_id);

    public function changeOwner($user_id, $item_id);

    public function getOwner($item_id);

    public function isOwner($user_id, $item_id);

    // Tree
    public function generateTree(array $items);

    public function buildTree($branch_id = 0);

    public function setBranch($leaf_id, $branch_id = 0);

    public function getBranch($leaf_id);

    public function getLeaves($branch_id);

    public function addLeaf($branch_id, $leaf_id);

    public function addLeaves($branch_id, array $leaves_id);

    public function removeLeaf($leaf_id);
}
