<?php

namespace App\Http\Controllers\Business\Logistics;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Business\Logistics\StorageDAO;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class StorageController extends Controller
{
    /**
     * [$storages description]
     * @var [storage]
     */
    protected $storages;

    /**
     * /
     * @param StorageDAO $storages [description]
     */
    public function __construct(StorageDAO $storages)
    {
        $this->storages = $storages;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [storage]        [description]
     */
    public function index()
    {
        $storages = $this->storages->getAll(request()->get("filters"));
        return $storages;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [storage]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['class', 'name']);
        if ($request->has('pk')) {
            $storage = $this->storages->update($input, (int) $request->get('pk'));
        } else {
            $storage = $this->storages->insert($input);
        }
        return $storage;
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $storage = $this->storages->getOne(['pk' => (int) $pk]);
        return $storage;
    }

    /**
     * /
     * @param  [storage]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [storage]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $storage = $this->storages->delete((int) $pk);
        return $storage;
    }
}
