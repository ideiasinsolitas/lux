<?php

namespace App\Models\Actions\Common;

trait ActivitySelector
{
    public function getAllActive(array $filters = array())
    {
        return $this->parseFilters(array_merge($filters, ['activity_greater' => 1]), false);
    }

    public function getActivePaginated(array $filters = array())
    {
        return $this->parseFilters(array_merge($filters, ['activity_greater' => 2]));
    }

    public function getDeactivatedPaginated(array $filters = array())
    {
        return $this->parseFilters(array_merge($filters, ['activity' => 1]));
    }

    public function getDeletedPaginated(array $filters = array())
    {
        return $this->parseFilters(array_merge($filters, ['activity' => 0]));
    }
}
