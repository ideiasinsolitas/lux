<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Ownership
{
    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function own($user_id, $item_id)
    {
        return DB::table('core_ownership')->insertGetId(['user_id' => $user_id, 'ownable_type' => $this->slug, 'ownable_id' => $item_id]);
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function change($user_id, $item_id)
    {
        return DB::table('core_ownership')
            ->where('ownable_type', $this->slug)
            ->where('ownable_id', $item_id)
            ->update(['user_id' => $user_id]);
    }

    /**
     * /
     * @param  [type]  $user_id [description]
     * @param  [type]  $item_id [description]
     * @return boolean          [description]
     */
    public function isOwner($user_id, $item_id)
    {
        return DB::table('core_ownership')
            ->select('user_id')
            ->where('user_id', $user_id)
            ->where('ownable_id', $item_id)
            ->get() ? true : false;
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getOwner($item_id)
    {
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return DB::table('core_users')
            ->join('core_ownership', 'core_users.id', 'core_ownership.user_id')
            ->select('user_id', 'username', 'email', 'first_name', 'last_name')
            ->where('ownable_type', $this->slug)
            ->where('ownable_id', $item_id)
            ->get();
    }
}
