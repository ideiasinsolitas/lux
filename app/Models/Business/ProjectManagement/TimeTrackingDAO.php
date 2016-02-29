<?php
namespace App\Repositories\Business\ProjectManagement;

use Illuminate\Support\Facades\DB;

use App\Repositories\DAO;
use App\Exceptions\GeneralException;
use App\Repositories\Business\ProjectManagement\Actions\TimeTrackingAction;
use App\Repositories\Business\ProjectManagement\Relationships\TimeTrackingRelationship;

class TimeTrackingDAO extends DAO
{
    use TimeTrackingAction,
        TimeTrackingRelationship;

    /**
     * /
     */
    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'date_pub',
            'order' => 'desc'
        ];

        parent::__construct('component_names', 'TimeTracking', $filters);
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->join()
            ->join()
            ->select('id', 'ticket_id', 'start', 'stop');
    }

    protected function parseFilters($filters = [], $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where($this->table . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where($this->table . '.activity', '>', $filters['activity_greater']);
        }

        if (isset($filters['id'])) {
            $this->builder->where($this->table . '.id', $filters['id']);
        }

        return $this->finish($filters);
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        $now = Carbon::now();
        $input['created'] = $now;
        $input['modified'] = $now;
        return DB::table($this->table)
            ->insertGetId($input);
    }

    /**
     * @param
     * @param
     * @return mixed
     */
    public function update($id, $input)
    {
        $input['modified'] = Carbon::now();
        return DB::table($this->table)
            ->update()
            ->where('id', $id);
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
            ->select('business_tickets.id')
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
                ->update('stop', DB::raw('NOW()'))
                ->where('id', $id);
        }
        throw new \Exception("Nothing to stop.", 004);
    }
}
