<?php

namespace App\DAL\Common\Relationships;

use Illuminate\Support\Facades\DB;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Collaborative
{
    public function enterCollaboration($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collaborations')
            ->insert([
                'user_id' => $user_id,
                'collaborative_type' => self::INTERNAL_TYPE,
                'collaborative_id' => $item_id
            ]);
    }

    public function leaveCollaboration($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collaborations')
            ->where('core_collaborations.user_id', $user_id)
            ->where('core_collaborations.collaborative_type', self::INTERNAL_TYPE)
            ->where('core_collaborations.collaborative_id', $item_id)
            ->delete();
    }

    public function userCollaborates($user_id, $item_id)
    {
        if (!is_int($user_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collaborations')
            ->select('core_collaborations.user_id')
            ->where('core_collaborations.user_id', $user_id)
            ->where('core_collaborations.collaborative_type', self::INTERNAL_TYPE)
            ->where('core_collaborations.collaborative_id', $item_id)
            ->first() ? true : false;
    }

    public function getCollaborators($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_users')
            ->join('core_collaborations', 'core_users.id', '=', 'core_collaborations.user_id')
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
