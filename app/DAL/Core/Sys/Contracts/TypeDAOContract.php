<?php

namespace App\DAL\Core\Sys\Contracts;

interface TypeDAOContract
{
    const TABLE = "core_types";
    
    const PK = "id";

    // DefaultModifier
    public function insert(array $input);

    public function update(array $input, $pk);

    // DefaultDeleter
    public function delete($pk);

    public function deleteMany(array $pks);

    // DefaultSelector
    public function getOne(array $filters);

    public function getAll(array $filters = array());

    public function getPaginated(array $filters = array());
}
