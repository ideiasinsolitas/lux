<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface CollectionDAOContract
{
    const TABLE = "core_collections";

    const PK = "id";

    const INTERNAL_TYPE = "Collection";

    const FK = "collection_id";

    const COLLECTOR_FK = "collector_id";

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    public function deleteMany(array $pks);
 /*
    // ActivityRestorer
    public function restore($pk);

    // Default Selector
    public function getAll(array $filters = array());

    // ActivityUpdater
    public function getActivity($pk);

    public function mark($pk, $activity);

    public function deactivate($pk);

    public function activate($pk);

    public function demote($pk);

    public function promote($pk);
*/
}
