<?php

namespace App\Models\Core\Taxonomy;

interface TermDAOContract
{
    const TABLE = "core_terms";
    const PK = "id";

    public function createNode($type);

    public function create(array $input);

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

    public function getAllActive(array $filters = array());

    public function getAllDeactivated(array $filters = array());

    public function getAllDeleted(array $filters = array());

    public function delete($id);

    public function deleteMany($ids);

    public function restore($id);

    public function getOne(array $filters);

    public function getAll(array $filters = array());

    public function getPaginated(array $filters = array());

    public function getActivity($pk);

    public function generateTree(array $items);

    public function buildTree($branch_id = 0);

    public function setBranch($leaf_id, $branch_id = 0);

    public function getBranch($leaf_id);

    public function getLeafs($branch_id);

    public function addLeaf($branch_id, $leaf_id);

    public function addLeaves($branch_id, $leaves_id);

    public function removeLeaf($leaf_id);
}
