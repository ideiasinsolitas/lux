<?php

namespace App\Http\Controllers\Business\Calendar\Calendar;

use App\Repositories\Business\Calendar\CalendarRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class CalendarController extends Controller
{
    /**
     * [$calendars description]
     * @var [type]
     */
    protected $calendars;

    /**
     * /
     * @param CalendarRepository $calendars [description]
     */
    public function __construct(CalendarRepository $calendars)
    {
        $this->calendars = $calendars;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.calendar.calendar');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $calendars = $this->calendars->getCalendarsPaginated(config('business.calendar.calendar.default_per_page'))->items();
        $res = [
            'status' => $calendars ? 'OK' : 'error',
            'result' => $calendars,
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
            $calendar = $this->calendars->create($input);
        } else {
            $calendar = $this->calendars->update($input);
        }
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'message' => trans('alerts.calendar.stored'),
            'result' => $calendar,
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
        $calendar = $this->calendars->findOrFail($id, true);
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'result' => $calendar,
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
        $calendar = $this->calendars->delete($id);
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'message' => trans("alerts.calendars.deleted"),
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
        $calendars = $this->calendars->deleteMany($var['ids']);
        $res = [
            'status' => $calendars ? 'OK' : 'error',
            'message' => trans("alerts.calendars.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteCalendarRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->calendars->delete($id);
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'message' => trans("alerts.calendars.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreCalendarRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->calendars->restore($id);
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'message' => trans("alerts.calendars.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkCalendarRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->calendars->mark($id, $status);
        $res = [
            'status' => $calendar ? 'OK' : 'error',
            'message' => trans("alerts.calendars.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $calendars = $this->calendars->getCalendarsPaginated(25, 0);
        $res = [
            'status' => $calendars ? 'OK' : 'error',
            'result' => $calendars,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $calendars = $this->calendars->getDeletedCalendarsPaginated(25);
        $res = [
            'status' => $calendars ? 'OK' : 'error',
            'result' => $calendars,
        ];
        return response()->json($res);
    }
}
