<?php

namespace App\DAL\Common\Contract;

interface CollaborativeContract
{
    const COLLABORATIONS_TABLE = 'core_collaborations';
    
    const COLLABORATIONS_PK = 'id';

    public function enterCollaboration($user_id, $item_id);

    public function leaveCollaboration($user_id, $item_id);

    public function userCollaborates($user_id, $item_id);

    public function getCollaborators($item_id);
}
