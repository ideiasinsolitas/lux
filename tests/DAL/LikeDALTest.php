<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\LikeDAO;

class LikeDALTest extends TestCase
{
    public function setUp()
    {
        
    }

    public function testDAO()
    {
        $dao = new LikeDAO();

        $result = $dao->create($input);

        $result = $dao->update($input, $pk);

        $result = $dao->delete($id);

        $result = $dao->getAll($filters = array());
    }
}
