<?php

namespace App\DAL\Business\ProjectManagement\Relationships;

use Illuminate\Support\Facades\DB;
use App\DAL\Common\Relationships;

trait TicketRelationship
{
    use Relationships\Collectable,
        Relationships\Likeable,
        Relationships\Votable,
        Relationships\Nodable,
        Relationships\Commentable;

    public function getCustomer($project_id)
    {
        return DB::table('core_users');
    }

    public function getResponsible($project_id)
    {
        return DB::table('core_users');
    }
}
