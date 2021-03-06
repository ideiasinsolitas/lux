<?php

namespace App\DAL;

abstract class AbstractDataMapper
{
    abstract public function fetchAll();

    abstract public function fetchById($id);

    abstract public function save(AbstractEntity $model);

    abstract public function remove(AbstractEntity $model);
}
