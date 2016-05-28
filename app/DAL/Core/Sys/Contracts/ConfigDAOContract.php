<?php

namespace App\DAL\Core\Sys\Contracts;

interface ConfigDAOContract
{
    const TABLE = "core_config";
    
    const PK = "id";

    public function getDefaultConfig();

    public function getUserConfig($user_id);

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // Activity Deleter
    public function restore($pk);

    // ActivityUpdater
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
}
