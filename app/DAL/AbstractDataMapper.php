<?php

namespace App\DAL\Abstractions;

abstract class AbstractDataMapper implements DataMapperContract
{
    abstract public function save(AbstractModel $model);
}
