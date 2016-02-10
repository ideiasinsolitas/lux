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
        $this->mark($id, 0);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteMany($ids)
    {
        return DB::table($this->mainTable)
            ->update(['activity' => $activity])
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
    public function promote($id)
    {
        DB::table($this->mainTable)->increment('activity');
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function demote($id)
    {
        DB::table($this->mainTable)->decrement('activity');
    }

    /**
     * /
     * @param [type] $id       [description]
     * @param [type] $activity [description]
     */
    public function mark($id, $activity)
    {
        return DB::table($this->mainTable)
            ->update(['activity' => $activity])
            ->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getActivity($id)
    {
        return DB::table($this->mainTable)
            ->select('activity')
            ->where('id', $id)
            ->get();
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function created($object)
    {
        $object->activity = 2;
        $object->created = '';
        $object->modified = '';
        return $object;
    }

    public function modified($object)
    {
        $object->modified = '';
        return $object;
    }
}
