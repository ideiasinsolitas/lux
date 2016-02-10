<?php
namespace App\Repositories\Business\Calendar\Calendar;

use Illuminate\Support\Facades\DB;

use App\Models\Business\Calendar\Calendar\Calendar;
use App\Repositories\Repository;

use App\Exceptions\GeneralException;

/**
 * Class EloquentCalendarRepository
 * @package App\Repositories\Calendar
 */
class CalendarRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Calendar\Calendar\Calendar';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Calendar::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getCalendarsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Calendar::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getEventsPaginated($calendar_id, $per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return DB::table('business_events')
            ->select('')
            ->where('calendar_id', $calendar_id)
            ->where('status', '>', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedCalendarsPaginated($per_page = 20)
    {
        return Calendar::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllCalendars($order_by = 'id', $sort = 'asc')
    {
        return Calendar::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws CalendarNeedsRolesException
     */
    public function create($input)
    {
        $calendar = Calendar::create($input);

        if ($calendar->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this calendar. Please try again.');
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $calendar = $this->findOrFail($id);

        if ($calendar->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this calendar. Please try again.');
    }
}
