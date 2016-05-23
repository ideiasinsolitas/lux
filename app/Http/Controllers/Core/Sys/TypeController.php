<?php

namespace App\Http\Controllers\Core\Sys\Type;

<<<<<<< HEAD
use App\Http\Controllers\Controller;

use App\DAL\Core\Sys\Contracts\TypeDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class TypeController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
=======
use App\Repositories\Core\Sys\TypeRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class TypeController extends Controller
{
    /**
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
     * [$types description]
     * @var [type]
     */
    protected $types;

    /**
     * /
<<<<<<< HEAD
     * @param TypeDAO $types [description]
     */
    public function __construct(RestProcessor $rest, TypeDAOContract $types)
    {
        $this->rest = $rest;
        $this->types = $types;
    }
    
=======
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

>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
<<<<<<< HEAD
        $types = $this->types->getAll();
        return $this->rest->process($types);
=======
        $types = $this->types->getTypesPaginated(config('core.sys.type.default_per_page'))->items();
        $res = [
            'status' => $types ? 'OK' : 'error',
            'result' => $types,
        ];
        return response()->json($res);
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
<<<<<<< HEAD
        $input = $request->only(['class', 'name']);
        if ($request->has('pk')) {
            $type = $this->types->update($input, (int) $request->get('pk'));
        } else {
            $type = $this->types->insert($input);
        }
        return $this->rest->process($type);
=======
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
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    }

    /**
     * Display the specified resource.
<<<<<<< HEAD
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $type = $this->types->getOne(['pk' => (int) $pk]);
        return $this->rest->process($type);
=======
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
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    }

    /**
     * /
<<<<<<< HEAD
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $type = $this->types->delete((int) $pk);
        return $this->rest->process($type);
=======
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
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
    }
}
