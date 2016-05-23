<?php

namespace App\DAL\Core\Sys\Contracts;

interface ConfigDAOContract
{
    const TABLE = "core_config";
    
    const PK = "id";

    public function insert(array $input);

    public function update(array $input, $pk);

    public function restore($pk);

    public function getDefaultConfig();

    public function getUserConfig($user_id);

    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
}
