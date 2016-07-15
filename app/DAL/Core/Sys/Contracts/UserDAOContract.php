<?php

namespace App\DAL\Core\Sys\Contracts;

interface UserDAOContract
{
    const TABLE = "core_users";

    const PROFILE_TABLE = "core_user_profiles";
    
    const PK = "id";

    const FK = "user_id";

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // ActivityRestorer
    public function restore($pk);

    // ActivityUpdater
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
}
