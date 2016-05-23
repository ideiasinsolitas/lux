<?php

namespace App\Http\Controllers\Business\Logistics\Storage;

use App\Repositories\Business\Logistics\StorageRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class StorageController extends Controller
{
    /**
     * [$storages description]
     * @var [type]
     */
    protected $storages;

    /**
     * /
     * @param StorageRepository $storages [description]
     */
    public function __construct(StorageRepository $storages)
    {
        $this->storages = $storages;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('businnes.logistics.storage');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $storages = $this->storages->getStoragesPaginated(config('businnes.logistics.storage.default_per_page'))->items();
        $res = [
            'status' => $storages ? 'OK' : 'error',
            'result' => $storages,
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
        $input = $request->only(['id', 'place_id', 'name', 'description']);
        if (isset($input['id'])) {
            $storage = $this->storages->create($input);
        } else {
            $storage = $this->storages->update($input);
        }
        $res = [
            'status' => $storage ? 'OK' : 'error',
            'message' => trans('alerts.storage.stored'),
            'result' => $storage,
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
        $storage = $this->storages->findOrFail($id, true);
        $res = [
            'status' => $storage ? 'OK' : 'error',
            'result' => $storage,
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
        $storage = $this->storages->delete($id);
        $res = [
            'status' => $storage ? 'OK' : 'error',
            'message' => trans("alerts.storages.deleted"),
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
        $storages = $this->storages->deleteMany($var['ids']);
        $res = [
            'status' => $storages ? 'OK' : 'error',
            'message' => trans("alerts.storages.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreStorageRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->storages->restore($id);
        $res = [
            'status' => $storage ? 'OK' : 'error',
            'message' => trans("alerts.storages.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkStorageRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->storages->mark($id, $status);
        $res = [
            'status' => $storage ? 'OK' : 'error',
            'message' => trans("alerts.storages.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $storages = $this->storages->getStoragesPaginated();
        $res = [
            'status' => $storages ? 'OK' : 'error',
            'result' => $storages,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $storages = $this->storages->getDeletedStoragesPaginated();
        $res = [
            'status' => $storages ? 'OK' : 'error',
            'result' => $storages,
        ];
        return response()->json($res);
    }
}
