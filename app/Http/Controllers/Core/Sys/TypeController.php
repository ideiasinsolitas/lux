<?php

namespace App\Http\Controllers\Core\Sys\Type;

use App\Repositories\Core\Sys\TypeRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class TypeController extends Controller
{
    /**
     * [$types description]
     * @var [type]
     */
    protected $types;

    /**
     * /
     * @param TypeRepository $types [description]
     */
    public function __construct(TypeRepository $types)
    {
        $this->types = $types;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.sys.type');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $types = $this->types->getTypesPaginated(config('core.sys.type.default_per_page'))->items();
        $res = [
            'status' => $types ? 'OK' : 'error',
            'result' => $types,
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
        $input = $request->only(['id', 'class', 'name']);
        if (isset($input['id'])) {
            $type = $this->types->create($input);
        } else {
            $type = $this->types->update($input);
        }
        $res = [
            'status' => $type ? 'OK' : 'error',
            'message' => trans('alerts.type.stored'),
            'result' => $type,
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
        $type = $this->types->findOrFail($id, true);
        $res = [
            'status' => $type ? 'OK' : 'error',
            'result' => $type,
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
        $type = $this->types->delete($id);
        $res = [
            'status' => $type ? 'OK' : 'error',
            'message' => trans("alerts.types.deleted"),
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
        $types = $this->types->deleteMany($var['ids']);
        $res = [
            'status' => $types ? 'OK' : 'error',
            'message' => trans("alerts.types.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteTypeRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->types->delete($id);
        $res = [
            'status' => $type ? 'OK' : 'error',
            'message' => trans("alerts.types.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreTypeRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->types->restore($id);
        $res = [
            'status' => $type ? 'OK' : 'error',
            'message' => trans("alerts.types.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkTypeRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->types->mark($id, $status);
        $res = [
            'status' => $type ? 'OK' : 'error',
            'message' => trans("alerts.types.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $types = $this->types->getTypesPaginated();
        $res = [
            'status' => $types ? 'OK' : 'error',
            'result' => $types,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $types = $this->types->getDeletedTypesPaginated();
        $res = [
            'status' => $types ? 'OK' : 'error',
            'result' => $types,
        ];
        return response()->json($res);
    }
}
