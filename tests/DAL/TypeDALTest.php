<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\TypeDAO;

class TypeDALTest extends TestCase
{
    public function setUp()
    {
        
    }

    public function testDAO()
    {
        $dao = new TypeDAO();

        $input = [];
        $pk = 1;

        $result = $dao->create($input);

        $result = $dao->update($input, $pk);

        $result = $dao->delete($pk);

        $result = $dao->deleteMany($pk);

        $result = $dao->getOne($filters);

        $result = $dao->getAll($filters = array());

        $result = $dao->getPaginated($filters = array());
    }
}
