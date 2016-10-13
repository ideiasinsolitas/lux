<?php

namespace App\DAL\Contracts;

interface UnitOfWorkContract
{
    public function register(AbstractEntity $entity);
    public function deregister(AbstractEntity $entity);

    public function commit();
    public function rollback();
    public function clear();
}
