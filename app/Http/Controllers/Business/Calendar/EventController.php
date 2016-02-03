<?php

namespace App\Http\Controllers\Business\Calendar\Event;

use App\Repositories\Business\Calendar\EventRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class EventController extends Controller
{
    /**
     * [$events description]
     * @var [type]
     */
    protected $events;

    /**
     * /
     * @param EventRepository $events [description]
     */
    public function __construct(EventRepository $events)
    {
        $this->events = $events;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.event.event');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $events = $this->events->getEventsPaginated(config('business.event.event.default_per_page'))->items();
        $res = [
            'status' => $events ? 'OK' : 'error',
            'result' => $events,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        if (isset($input['id'])) {
            $event = $this->events->create($input);
        } else {
            $event = $this->events->update($input);
        }
        $res = [
            'status' => $event ? 'OK' : 'error',
            'message' => trans('alerts.event.stored'),
            'result' => $event,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $event = $this->events->findOrFail($id, true);
        $res = [
            'status' => $event ? 'OK' : 'error',
            'result' => $event,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $event = $this->events->delete($id);
        $res = [
            'status' => $event ? 'OK' : 'error',
            'message' => trans("alerts.events.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
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
        $events = $this->events->deleteMany($var['ids']);
        $res = [
            'status' => $events ? 'OK' : 'error',
            'message' => trans("alerts.events.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteEventRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->events->delete($id);
        $res = [
            'status' => $event ? 'OK' : 'error',
            'message' => trans("alerts.events.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreEventRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->events->restore($id);
        $res = [
            'status' => $event ? 'OK' : 'error',
            'message' => trans("alerts.events.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkEventRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->events->mark($id, $status);
        $res = [
            'status' => $event ? 'OK' : 'error',
            'message' => trans("alerts.events.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $events = $this->events->getEventsPaginated(25, 0);
        $res = [
            'status' => $events ? 'OK' : 'error',
            'result' => $events,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $events = $this->events->getDeletedEventsPaginated(25);
        $res = [
            'status' => $events ? 'OK' : 'error',
            'result' => $events,
        ];
        return response()->json($res);
    }
}
