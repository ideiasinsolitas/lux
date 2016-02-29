<?php

namespace App\Repositories\Relationships\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Collaborative
{
    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function enterCollaboration($user_id, $item_id)
    {
        $collaborative_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collaborations')
            ->insert([
                'user_id' => $user_id,
                'collaborative_type' => $collaborative_type,
                'collaborative_id' => $item_id
            ]);
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function leaveCollaboration($user_id, $item_id)
    {
        $collaborative_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collaborations')
            ->where('user_id', $user_id)
            ->where('collaborative_type', $collaborative_type)
            ->where('collaborative_id', $item_id)
            ->delete();
    }

    /**
     * /
     * @param  [type]  $user_id [description]
     * @param  [type]  $item_id [description]
     * @return boolean          [description]
     */
    public function isUserInTeam($user_id, $item_id)
    {
        $collaborative_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collaborations')
            ->select('user_id')
            ->where('user_id', $user_id)
            ->where('collaborative_type', $collaborative_type)
            ->where('collaborative_id', $item_id)
            ->get();
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getTeam($item_id)
    {
        $collaborative_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_users')
            ->join('core_collaborations', 'core_users.id', 'core_collaborations.user_id')
            ->select('')
            ->where('collaborative_type', $collaborative_type)
            ->where('collaborative_id', $item_id)
            ->get();
    }
}
