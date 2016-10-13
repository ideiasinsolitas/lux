<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface BlockDAOContract
{
    const TABLE = "core_blocks";

    const PK = "id";

    const FK = "block_id";

    public function getArea(array $filters = array());

    public function getByAreaId(array $filters = array());

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    public function getAll(array $filters = array());
}
