<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface AreaDAOContract
{
    const TABLE = "core_areas";

    const PK = "id";

    const FK = "area_id";

    const BLOCK_TABLE = "core_blocks";

    const BLOCK_PK = "id";

    public function getBlocks($pk);

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    // DefaultSelector
    public function getAll(array $filters = array());

    public function getOne(array $filters);
}
