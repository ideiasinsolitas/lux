<?php

namespace App\DAL;

interface UnitOfWorkContract
{
    public function register(AbstractEntity $entity);
    public function commit();
    public function rollback();
    public function clear();
}
