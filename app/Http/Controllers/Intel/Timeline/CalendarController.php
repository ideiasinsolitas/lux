<?php

namespace App\Http\Controllers\Business\Calendar\Calendar;

use App\Repositories\Business\Calendar\CalendarRepository;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class CalendarController extends Controller
{
    /**
     * [$calendars description]
     * @var [type]
     */
    protected $calendars;

    protected $handler;
    /**
     * /
     * @param CalendarRepository $calendars [description]
     */
    public function __construct(ResponseHandler $handler, CalendarRepository $calendars)
    {
        $handler->setPrefix('business.calendar');
        $this->handler = $handler;
        $this->calendars = $calendars;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $calendars = $this->calendars
            ->getCalendarsPaginated(config('business.calendar.calendar.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($calendars);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', ]);
        $calendar = $request->has('id')
            ? $this->calendars
                ->update($input)
            : $this->calendars
                ->create($input);

        return $this->handler
            ->apiResponse($calendar, 'stored');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->calendars
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
        $calendar = $this->calendars
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
        $calendars = $this->calendars
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($calendars, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreCalendarRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->calendars
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkCalendarRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->calendars
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $calendars = $this->calendars
            ->getCalendarsPaginated();
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $calendars = $this->calendars
            ->getDeletedCalendarsPaginated();
            
        return $this->handler
            ->apiResponse($calendar);
    }
}
