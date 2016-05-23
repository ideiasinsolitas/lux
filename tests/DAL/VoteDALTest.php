<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\VoteDAO;

class VoteDALTest extends TestCase
{
    public function setUp()
    {
        
    }

    public function testDAO()
    {
        $dao = new VoteDAO();

        $result = $dao->create($input);

        $pk = $result;
        
        $result = $dao->update($input, $pk);

        $result = $dao->delete($pk);

        $result = $dao->getAll($filters = array());
    }
}
