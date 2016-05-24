<?php

namespace App\Models;

abstract class AbstractTable
{
    protected $tableNames = array();

    abstract public function create();

    abstract public function drop();

    abstract public function dropAndCreate();

    abstract public function getSqlSchema();

    abstract public function getTableNames();
}
