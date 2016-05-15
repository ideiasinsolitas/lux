<?php

namespace App\DAL\Relationships\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Collaborative
{
    public function enterCollaboration($user_id, $item_id)
    {
        return DB::table('core_collaborations')
            ->insert([
                'user_id' => $user_id,
                'collaborative_type' => self::INTERNAL_TYPE,
                'collaborative_id' => $item_id
            ]);
    }

    public function leaveCollaboration($user_id, $item_id)
    {
        $collaborative_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table('core_collaborations')
            ->where('user_id', $user_id)
            ->where('collaborative_type', $collaborative_type)
            ->where('collaborative_id', $item_id)
            ->delete();
    }

    public function isUserInTeam($user_id, $item_id)
    {
        $collaborative_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table('core_collaborations')
            ->select('user_id')
            ->where('user_id', $user_id)
            ->where('collaborative_type', $collaborative_type)
            ->where('collaborative_id', $item_id)
            ->get();
    }

    public function getTeam($item_id)
    {
        return DB::table('core_users')
            ->join('core_collaborations', 'core_users.id', 'core_collaborations.user_id')
            ->select(
                'core_users.id',
                'core_users.display_name'
            )
            ->where('core_users.activity' > 0)
            ->where('core_collaborations.collaborative_type', self::INTERNAL_TYPE)
            ->where('core_collaborations.collaborative_id', $item_id)
            ->get();
    }
}
