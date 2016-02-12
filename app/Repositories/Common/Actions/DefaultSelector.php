<?php

namespace App\Repositories\Actions\Common;

trait DefaultSelector
{
    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAll($filters = [])
    {
        return $this->parseFilters($filters, false);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPaginated($filters = [])
    {
        return $this->parseFilters($filters);
    }
}
