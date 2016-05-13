<?php

namespace App\Models\Core\SiteBuilding\Contracts;

interface BlockDAOContract
{
    public function create(array $input);

    public function update(array $input, $pk);

    public function delete($pk);

    public function getAll(array $filters = array());

    public function getArea(array $filters = array());

    public function getByAreaId(array $filters = array());
}
