<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\DAL\Core\Taxonomy\TermDAO;

class TermDALTest extends TestCase
{
    public function setUp()
    {
        
    }

    public function testDAO()
    {
        $dao = new TermDAO();

        $input = [];
        $pk = 1;
        $lang = 'pt';

        $result = $dao->createNode($type);

        $result = $dao->create($input);

        $result = $dao->update($input, $pk);

        $result = $dao->addTranslation($item_id, $lang, $input);

        $result = $dao->updateTranslation($item_id, $lang, $input);

        $result = $dao->getAllTranslations($item_id);

        $result = $dao->getTranslation($item_id, $lang);

        $result = $dao->getSlug($item_id, $lang);

        $result = $dao->getTranslationBySlug($slug);

        $result = $dao->removeTranslation($item_id, $lang);

        $result = $dao->generateSlug($string);

        $result = $dao->slugExists($slug);

        $result = $dao->getAllActive($filters = array());

        $result = $dao->getAllDeactivated($filters = array());

        $result = $dao->getAllDeleted($filters = array());

        $result = $dao->delete($id);

        $result = $dao->deleteMany($ids);

        $result = $dao->restore($id);

        $result = $dao->getOne($filters);

        $result = $dao->getAll($filters = array());

        $result = $dao->getPaginated($filters = array());

        $result = $dao->getActivity($pk);

        $result = $dao->generateTree($items);

        $result = $dao->buildTree($branch_id = 0);

        $result = $dao->setBranch($leaf_id, $branch_id = 0);

        $result = $dao->getBranch($leaf_id);

        $result = $dao->getLeafs($branch_id);

        $result = $dao->addLeaf($branch_id, $leaf_id);

        $result = $dao->addLeaves($branch_id, $leaves_id);

        $result = $dao->removeLeaf($leaf_id);
    }
}
