<?php

namespace App\Models\Core\SiteBuilding\Contracts;

interface AreaDAOContract
{
    public function create(array $input);

    public function update(array $input, $pk);

    public function delete($pk);

    public function getAll(array $filters = array());

    public function getOne(array $filters = array());

    public function getBlocks(array $filters = array());
}
