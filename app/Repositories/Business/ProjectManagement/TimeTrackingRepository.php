<?php

namespace App\Repositories\Business\ProjectManagement;

use App\Exceptions\GeneralException;
use App\Models\Project\TimeTracking;

class TimeTrackingRepository
{
    public function __construct()
    {
        $this->model = 'App\Models\Business\ProjectManagement\TimeTracking';
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    protected function getCurrentId($user_id)
    {
        return DB::table('business_time_tracking')
            ->join('business_tickets', 'business_time_tracking.ticket_id', 'business_tickets.id')
            ->join('core_users', 'business_tickets.user_id', 'core_users.id')
            ->select()
            ->where('business_time_tracking.stop', null)
            ->where('core_users.user_id', $user_id)
            ->get();
    }

    /**
     * /
     * @param  [type] $ticket_id [description]
     * @param  [type] $user_id   [description]
     * @return [type]            [description]
     */
    public function start($ticket_id, $user_id)
    {
        if ($this->getCurrentId($user_id)) {
            $this->stop($user_id);
        }

        return DB::table('business_time_tracking')
            ->insert([
                'ticket_id' => $ticket_id,
                'start' => DB::raw('NOW()')
                ]);
    }

    /**
     * /
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function stop($user_id)
    {
        $currentId = $this->getCurrentId($user_id);

        if ($currentId) {
            $id = $currentId;
            return DB::table('business_time_tracking')
                ->update()
                ->where('id', $id);
        }
        throw new \Exception("Nothing to stop.", 004);
    }
}
