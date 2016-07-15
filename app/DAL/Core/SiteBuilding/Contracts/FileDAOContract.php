<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface FileDAOContract
{
    const TABLE = "core_files";

    const PK = "id";

    const INTERNAL_TYPE = "File";

    const FK = "file_id";

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    public function deleteMany($pk);

    // ActivityRestorer
    public function restore($pk);

    // DefaultSelector
    public function getAll(array $filters = array());

    // ActivittUpdater
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
}
