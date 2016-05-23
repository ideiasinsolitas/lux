<?php

namespace App\DAL\Core\SiteBuilding\Contracts;

interface BlockDAOContract
{
    const TABLE = "core_blocks";

    const PK = "id";

    public function insert(array $input);

    public function update(array $input, $pk);

    public function delete($pk);

    public function getAll(array $filters = array());

    public function getArea(array $filters = array());

    public function getByAreaId(array $filters = array());
}
