<?php

namespace App\DAL\Business\ProjectManagement\Relationships;

use Illuminate\Support\Facades\DB;
use App\DAL\Common\Relationships;

trait ProjectRelationship
{
    use Relationships\Collaborative,
        Relationships\Ownable,
        Relationships\Nodable,
        Relationships\UserTaggable;

    public function getTickets($project_id)
    {
        return DB::table('business_tickets')
            ->select('id', 'responsible_id', 'customer_id', 'problem_url', 'description', 'activity', 'created', 'modified', 'deleted')
            ->where('project_id', $project_id)
            ->get();
    }
}
