<?php

namespace App\Repositories\Common;

use Illuminate\Support\Facades\DB;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Ownable
{
    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function own($user_id, $item_id)
    {
        return DB::table('core_ownership')
            ->insertGetId([
                'user_id' => $user_id,
                'ownable_type' => $this->type,
                'ownable_id' => $item_id
            ]);
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function changeOwner($user_id, $item_id)
    {
        return DB::table('core_ownership')
            ->where('ownable_type', $this->type)
            ->where('ownable_id', $item_id)
            ->update(['user_id' => $user_id]);
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getOwner($item_id)
    {
        $type = DB::raw($this->type);
        return DB::table('core_users')
            ->join('core_ownership', function ($q) use ($item_id, $type) {
                return $q->on('core_ownership.ownable_type', $type)
                    ->where('core_ownership.ownable_id', $item_id);
            })
            ->join('core_ownership', 'core_users.id', 'core_ownership.user_id')
            ->select('core_users.id', 'core_users.first_name', 'core_users.middle_name', 'core_users.last_name')
            ->first();
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
}
