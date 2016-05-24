<?php

namespace App\Http\Controllers\Core\SiteBuilding\Area;

use App\Repositories\Core\SiteBuilding\AreaDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class AreaController extends Controller
{
    /**
     * [$areas description]
     * @var [type]
     */
    protected $areas;

    /**
     * /
     * @param AreaDAO $areas [description]
     */
    public function __construct(AreaDAO $areas)
    {
        $this->areas = $areas;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.site_building.area');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $areas = $this->areas->getAreasPaginated(config('core.site_building.area.default_per_page'))->items();
        $res = [
            'status' => $areas ? 'OK' : 'error',
            'result' => $areas,
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
        $input = $request->only(['id', 'name', 'activity']);
        if (isset($input['id'])) {
            $area = $this->areas->create($input);
        } else {
            $area = $this->areas->update($input);
        }
        $res = [
            'status' => $area ? 'OK' : 'error',
            'message' => trans('alerts.area.stored'),
            'result' => $area,
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
        $area = $this->areas->findOrFail($id, true);
        $res = [
            'status' => $area ? 'OK' : 'error',
            'result' => $area,
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
        $area = $this->areas->delete($id);
        $res = [
            'status' => $area ? 'OK' : 'error',
            'message' => trans("alerts.areas.deleted"),
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
        $areas = $this->areas->deleteMany($var['ids']);
        $res = [
            'status' => $areas ? 'OK' : 'error',
            'message' => trans("alerts.areas.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteAreaRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->areas->delete($id);
        $res = [
            'status' => $area ? 'OK' : 'error',
            'message' => trans("alerts.areas.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreAreaRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->areas->restore($id);
        $res = [
            'status' => $area ? 'OK' : 'error',
            'message' => trans("alerts.areas.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkAreaRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->areas->mark($id, $status);
        $res = [
            'status' => $area ? 'OK' : 'error',
            'message' => trans("alerts.areas.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $areas = $this->areas->getAreasPaginated();
        $res = [
            'status' => $areas ? 'OK' : 'error',
            'result' => $areas,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $areas = $this->areas->getDeletedAreasPaginated();
        $res = [
            'status' => $areas ? 'OK' : 'error',
            'result' => $areas,
        ];
        return response()->json($res);
    }
}
