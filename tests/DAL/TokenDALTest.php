<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\TokenDAO;

class TokenDALTest extends TestCase
{
    public function setUp()
    {
        
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
