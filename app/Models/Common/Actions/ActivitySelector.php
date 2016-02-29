<?php

namespace App\Repositories\Actions\Common;

trait ActivitySelector
{
    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getAllActive($filters = [])
    {
        return $this->parseFilters(array_merge($filters, ['activity_greater' => 1]), false);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getActivePaginated($filters = [])
    {
        return $this->parseFilters(array_merge($filters, ['activity_greater' => 2]));
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivatedPaginated($filters = [])
    {
        return $this->parseFilters(array_merge($filters, ['activity' => 1]));
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPaginated($filters = [])
    {
        return $this->parseFilters(array_merge($filters, ['activity' => 0]));
    }
}
