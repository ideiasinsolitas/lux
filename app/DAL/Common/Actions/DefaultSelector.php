<?php

namespace App\DAL\Actions\Common;

trait DefaultSelector
{
    public function getOne(array $filters)
    {
        if (!isset($filters['pk'])) {
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
