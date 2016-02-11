<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Activity
{
    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        return DB::table($this->table)
            ->update(['activity' => $activity, 'deleted' => Carbon::now()])
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteMany($ids)
    {
        return DB::table($this->table)
            ->update(['activity' => $activity, 'deleted' => Carbon::now()])
            ->whereIn('id', $ids);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deactivate($id)
    {
        $this->mark($id, 1);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function activate($id)
    {
        $this->mark($id, 2);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function demote($id)
    {
        $old = $this->getActivity($id);
        $new = $old - 1;
        $activity = $new >= 0 ? $new : 0;
        $this->mark($id, $activity);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function promote($id)
    {
        $old = $this->getActivity($id);
        $activity = $old + 1;
        $this->mark($id, $activity);
    }

    /**
     * /
     * @param [type] $id       [description]
     * @param [type] $activity [description]
     */
    public function mark($id, $activity)
    {
        return DB::table($this->table)
            ->update(['activity' => $activity, 'modified' => Carbon::now()])
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getActivity($id)
    {
        return DB::table($this->table)
            ->select('activity')
            ->where('id', $id)
            ->get();
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getAllActive($order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)->where('activity', '>', $status)->orderBy($order_by, $sort);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getActivePaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)->where('activity', '>', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivatedPaginated($per_page = 20)
    {
        return DB::table($this->table)->where('activity', 1)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPaginated($per_page = 20)
    {
        return DB::table($this->table)->where('activity', 0)->paginate($per_page);
    }
}
