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
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deactivate($id)
    {
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function activate($id)
    {
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function promote($id)
    {
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function demote($id)
    {
    }

    /**
     * /
     * @param [type] $id       [description]
     * @param [type] $activity [description]
     */
    public function setActivity($id, $activity)
    {
        $sql = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($sql, array('id' => $id, 'activity' => $activity));
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getActivity($id)
    {
        $sql = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
