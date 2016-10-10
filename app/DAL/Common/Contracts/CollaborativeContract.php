<?php

namespace App\DAL\Common\Contract;

interface CollaborativeContract
{
    const COLLABORATION_TABLE = 'core_collaborations';
    
    const COLLABORATION_FK = 'collaborative_id';

    public function enterCollaboration($user_id, $item_id);

    public function leaveCollaboration($user_id, $item_id);

    public function userCollaborates($user_id, $item_id);

    public function getCollaborators($item_id);
}
