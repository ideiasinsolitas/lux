<?php
namespace App\DAL\Business\ProjectManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\ProjectManagement\Contracts\TimeTrackingDAOContract;
use App\DAL\Business\ProjectManagement\Actions\TimeTrackingAction;
use App\DAL\Business\ProjectManagement\Relationships\TimeTrackingRelationship;

class TimeTrackingDAO implements TimeTrackingDAOContract
{
    use DAOTrait;

    /**
     * /
     */
    public function __construct()
    {
        $this->filters = [
            'sort' => self::PK . ',desc',
        ];

        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('business_tickets', self::TABLE . '.ticket_id', '=', 'business_tickets.id')
            ->select(
                self::TABLE . '.id',
                self::TABLE . '.ticket_id',
                self::TABLE . '.start',
                self::TABLE . '.stop'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }

        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.id', $filters[self::PK]);
        }

        return $this->finish($filters);
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
            ->first();
    }

    public function getAll(array $filters = array())
    {
        return $this->parseFilters($filters, false);
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
                ->where(self::PK, $pk);
        }
        return false;
    }
}
