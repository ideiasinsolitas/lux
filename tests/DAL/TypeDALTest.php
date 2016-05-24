<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\TypeDAO;
use App\Models\Core\Sys\Tables\TypeTable;

class TypeDALTest extends TestCase
{
    public function setUp()
    {
        $table = new TypeTable();
        if (!$table->create()) {
            throw new \Exception("Could not create table", 1);
        }
    }

    public function tearDown()
    {
        $table = new TypeTable();
        if (!$table->drop()) {
            throw new \Exception("Could not drop table", 1);
        }
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
