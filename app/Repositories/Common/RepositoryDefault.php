<?php

namespace App\Repositories\Common;

trait RepositoryDefault
{
    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        return DB::table($this->table)
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return DB::table($this->table)
            ->update($input)
            ->where('id', $id);
    }

    public function delete($id)
    {
        return DB::table($this->mainTable)
            ->where('id', $id)
            ->delete();
    }

    public function deleteMany($ids)
    {
        return DB::table($this->mainTable)
            ->whereIn('id', $ids)
            ->delete();
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAll($order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)->orderBy($order_by, $sort)->get();
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPaginated($per_page = 20, $order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        return $this->getBuilder()
            ->select()
            ->where($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getFullPublishedPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return $this->getBuilder()
            ->where('activity', '>', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }
}
