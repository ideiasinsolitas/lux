<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface ResourceDAOContract
{
    const TABLE = "core_resources";

    const PK = "id";

    const INTERNAL_TYPE = "Resource";

    const FK = "resource_id";
    
    //
    public function insert(array $input);

    public function update(array $input, $pk);

    //
    public function delete($pk);

    public function deleteMany($pk);

    //
    public function restore($pk);

    //
    public function getAll(array $filters = array());

    //
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
}
