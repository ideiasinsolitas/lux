<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\TokenDAO;
use App\Models\Core\Sys\Tables\TokenTable;

class TokenDALTest extends TestCase
{
    public function setUp()
    {
        $table = new TokenTable();
        if (!$table->create()) {
            throw new \Exception("Could not create table", 1);
        }
    }

    public function tearDown()
    {
        $table = new TokenTable();
        if (!$table->drop()) {
            throw new \Exception("Could not drop table", 1);
        }
    }

    public function testDAO()
    {
        $dao = new TokenDAO();
        
        $user_id = 1;
        $token = $dao->generate($user_id, 'test_type');
        $t_array = (array) $token;
        $valid = $dao->validate($token, 'test_type');
    }
}
