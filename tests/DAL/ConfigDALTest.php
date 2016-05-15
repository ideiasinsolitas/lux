<?php

namespace Testing\DAL;

use Testing\Cases\TestCase;

use App\Models\Core\Sys\ConfigDAO;

class ConfigDALTest extends TestCase
{
    public function setUp()
    {
        
    }

    public function testDAO()
    {
        $dao = new ConfigDAO();

        $input = [];
        $pk = 1;
        $user_id = 1;
        $activity = 3;
        
        $result = $dao->create($input);

        $result = $dao->update($input, $pk);

        $result = $dao->getDefaultConfig();

        $result = $dao->getUserConfig($user_id);

        $result = $dao->getActivity($pk);

        $result = $dao->mark($pk, $activity);

        $result = $dao->deactivate($pk);

        $result = $dao->activate($pk);

        $result = $dao->demote($pk);

        $result = $dao->promote($pk);

        $result = $dao->delete($pk);

        $result = $dao->deleteMany($pk);

        $result = $dao->restore($pk);
    }
}
