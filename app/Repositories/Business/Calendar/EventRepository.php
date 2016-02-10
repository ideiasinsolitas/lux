<?php
namespace App\Repositories\Business\Calendar\Event;

use Illuminate\Support\Facades\DB;

use App\Models\Business\Calendar\Event\Event;
use App\Repositories\Repository;

use App\Repositories\Common\Activity;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Collectable;
use App\Repositories\Common\Commentable;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\OwnerTaggable;
use App\Repositories\Common\Ownable;
use App\Repositories\Common\Typed;
use App\Repositories\Common\UserTaggable;
use App\Repositories\Common\Votable;

use App\Exceptions\GeneralException;

/**
 * Class EloquentEventRepository
 * @package App\Repositories\Event
 */
class EventRepository extends Repository
{
    use Activity,
        Builder,
        Collaborative,
        Collectable,
        Likeable,
        OwnerTaggable,
        Ownable,
        Typed,
        UserTaggable,
        Votable;

    /**
     * /
     */
    public function __construct()
    {
        $this->mainTable = 'business_events';
        $this->modelPath = 'App\Models\Business\Calendar\Event';
        $this->type = 'Event';
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
        return DB::table('core_events')
            ->insertGetId($input);
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
        return DB::table('core_events')
            ->update($input)
            ->where('id', $id);
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
        return Event::where('status', '>', $status)->orderBy($order_by, $sort)->paginate($per_page)->items();
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivatedEventsPaginated($per_page = 20)
    {
        return Event::where('activity', 1)->paginate($per_page)->items();
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedEventsPaginated($per_page = 20)
    {
        return Event::where('activity', 0)->paginate($per_page)->items();
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
}
