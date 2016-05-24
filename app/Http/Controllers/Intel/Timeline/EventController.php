<?php

namespace App\Http\Controllers\Business\Calendar\Event;

use App\Repositories\Business\Calendar\EventDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class EventController extends Controller
{
    /**
     * [$events description]
     * @var [type]
     */
    protected $events;

    protected $handler;
    /**
     * /
     * @param EventDAO $events [description]
     */
    public function __construct(ResponseHandler $handler, EventDAO $events)
    {
        $handler->setPrefix('business.calendar.event');
        $this->handler = $handler;
        $this->events = $events;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $calendar = $request->has('id')
            ? $this->events
                ->update($input)
            : $this->events
                ->create($input);

        return $this->handler
            ->apiResponse($calendar, 'stored');
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $events = $this->events
            ->getEventsPaginated(config('business.calendar.event.default_per_page'));
            
        return $this->handler
            ->apiResponse($events);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $events = $this->events
            ->getDeactivatedEventsPaginated(config('business.calendar.event.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $events = $this->events
            ->getDeletedEventsPaginated(config('business.calendar.event.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->events
            ->findOrFail($id, true);

        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $calendar = $this->events
            ->delete($id);

        return $this->handler
            ->apiResponse($calendar, 'deleted');
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function deleteMany(DeleteRequest $request)
    {
        $ids = $request->only('ids');
        $events = $this->events
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($events, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreEventRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->events
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkEventRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->events
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
