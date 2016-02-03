<?php
namespace App\Repositories\Business\Calendar\Event;

use App\Models\Business\Calendar\Event\Event;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentEventRepository
 * @package App\Repositories\Event
 */
class EventRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Calendar\Event\Event';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Event::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getEventsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Event::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedEventsPaginated($per_page = 20)
    {
        return Event::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllEvents($order_by = 'id', $sort = 'asc')
    {
        return Event::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws EventNeedsRolesException
     */
    public function create($input)
    {
        $event = Event::create($input);

        if ($event->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this name. Please try again.');
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
        $event = $this->findOrFail($id);

        if ($event->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this name. Please try again.');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            throw new GeneralException("You can not delete yourself.");
        }

        $event = $this->findOrFail($id);
        if ($event->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this name. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $event = $this->findOrFail($id, true);

        try {
            $event->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $event = $this->findOrFail($id);

        if ($event->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this name. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if (auth()->id() == $id && ($status == 0 || $status == 2)) {
            throw new GeneralException("You can not do that to yourself.");
        }

        $event = $this->findOrFail($id);
        $event->status = $status;

        if ($event->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this name. Please try again.");
    }
}
