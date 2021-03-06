<?php

namespace App\DAL\Common\Actions;

trait DefaultSelector
{
    public function getOne(array $filters)
    {
        if (!isset($filters[self::PK])) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->parseFilters($filters);
    }

    public function getAll(array $filters = array())
    {
        return $this->parseFilters($filters, false);
    }

    public function getPaginated(array $filters = array())
    {
        return $this->parseFilters($filters);
    }
}
