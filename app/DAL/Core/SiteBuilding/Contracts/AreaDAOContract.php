<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface AreaDAOContract
{
    const TABLE = "core_areas";

    const PK = "id";

    public function insert(array $input);

    public function update(array $input, $pk);

    public function delete($pk);

    public function getAll(array $filters = array());

    public function getOne(array $filters = array());

    public function getBlocks(array $filters = array());
}
