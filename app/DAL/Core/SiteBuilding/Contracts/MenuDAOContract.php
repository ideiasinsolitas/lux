<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface MenuDAOContract
{
    const TABLE = "core_menus";

    const PK = "id";

    //
    public function insert(array $input);

    public function update(array $input, $pk);

    //
    public function delete($pk);

    public function deleteMany($pk);

    //
    public function restore($pk);

    //
    public function getAll(array $filters = array());

    //
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);

    // Tree
    public function generateTree(array $items);

    public function buildTree($branch_id = 0);

    public function setBranch($leaf_id, $branch_id = 0);

    public function getBranch($leaf_id);

    public function getLeafs($branch_id);

    public function addLeaf($branch_id, $leaf_id);

    public function addLeaves($branch_id, $leaves_id);

    public function removeLeaf($leaf_id);
}
