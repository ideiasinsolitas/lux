<?php

namespace App\DAL\Core\Sys\Contracts;

interface TypeDAOContract
{
    const TABLE = "core_types";
    
    const PK = "id";

    public function insert(array $input);

    public function update(array $input, $pk);

    public function delete($pk);

    public function deleteMany(array $pks);

    public function getOne(array $filters);

    public function getAll(array $filters = array());

    public function getPaginated(array $filters = array());
}
