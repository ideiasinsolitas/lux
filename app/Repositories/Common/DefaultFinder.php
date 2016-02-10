<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultFinder
{
    public function findOrFail($id)
    {
        $model = $this->modelPath;
        return $model::findOrFail($id);
    }

    public function getPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        $model = $this->modelPath;
        return $model::where('status', '>', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }
}
