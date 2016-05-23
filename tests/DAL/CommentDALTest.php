<?php
namespace Testing\DAL;

use Testing\Cases\TestCase;

use \stdClass;
use Illuminate\Support\Collection;
use App\Models\Core\Sys\CommentDAO;

class CommentDALTest extends TestCase
{
    protected $initialData;

    public function setUp()
    {
        $this->initialData = [];
    }

    public function testDAO()
    {
        $dao = new CommentDAO();

        $result = $dao->createNode($type);
        $this->assertInternalType('', $result);
        $this->assertEquals('', $result);
        $this->assertTrue($result);
        $this->assertInstanceOf('', $result);

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

        $result = $dao->delete($id);

        $result = $dao->deleteMany($ids);

        $result = $dao->getOne($filters);

        $result = $dao->getAll($filters = array());

        $result = $dao->own($user_id, $item_id);

        $result = $dao->changeOwner($user_id, $item_id);

        $result = $dao->getOwner($item_id);

        $result = $dao->isOwner($user_id, $item_id);

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
