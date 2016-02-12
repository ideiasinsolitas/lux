<?php

namespace App\Repositories\Actions\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait ActivityUpdater
{
    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getActivity($id)
    {
        $builder = DB::table($this->table)
            ->select('activity')
            ->where('id', $id)
            ->get();
    }

    /**
     * /
     * @param [type] $id       [description]
     * @param [type] $activity [description]
     */
    public function mark($id, $activity)
    {
        return DB::table($this->table)
            ->update(['activity' => $activity])
            ->where('id', $id);
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
}
