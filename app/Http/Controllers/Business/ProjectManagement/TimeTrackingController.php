<?php

namespace App\Http\Controllers\Business\ProjectManagement\TimeTracking;

use App\Repositories\Business\ProjectManagementTimeTrackingRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class TimeTrackingController extends Controller
{
    /**
     * [$timeTracking description]
     * @var [type]
     */
    protected $timeTracking;

    /**
     * /
     * @param TimeTrackingRepository $timeTracking [description]
     */
    public function __construct(TimeTrackingRepository $timeTracking)
    {
        $this->timeTracking = $timeTracking;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.project_management.time_tracking');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $timeTracking = $this->timeTracking->getTimeTrackingsPaginated(config('business.project_management.time_tracking.default_per_page'))->items();
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'result' => $timeTracking,
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
            $timeTracking = $this->timeTracking->create($input);
        } else {
            $timeTracking = $this->timeTracking->update($input);
        }
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans('alerts.time_tracking.stored'),
            'result' => $timeTracking,
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
        $timeTracking = $this->timeTracking->findOrFail($id, true);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'result' => $timeTracking,
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
        $timeTracking = $this->timeTracking->delete($id);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans("alerts.time_trackings.deleted"),
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
        $timeTracking = $this->timeTracking->deleteMany($var['ids']);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans("alerts.time_trackings.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteTimeTrackingRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->timeTracking->delete($id);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans("alerts.time_trackings.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreTimeTrackingRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->timeTracking->restore($id);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans("alerts.time_trackings.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkTimeTrackingRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->timeTracking->mark($id, $status);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'message' => trans("alerts.time_trackings.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $timeTracking = $this->timeTracking->getTimeTrackingsPaginated(25, 0);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'result' => $timeTracking,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $timeTracking = $this->timeTracking->getDeletedTimeTrackingsPaginated(25);
        $res = [
            'status' => $timeTracking ? 'OK' : 'error',
            'result' => $timeTracking,
        ];
        return response()->json($res);
    }
}
