<?php

namespace App\Http\Controllers\Core\Sys\Resource;

use App\Repositories\Core\Sys\ResourceDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class ResourceController extends Controller
{
    /**
     * [$resources description]
     * @var [type]
     */
    protected $resources;

    protected $handler;

    /**
     * /
     * @param ResourceDAO $resources [description]
     */
    public function __construct(ResourceDAO $resources)
    {
        $this->resources = $resources;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function save(StoreRequest $request)
    {
        $input = $request->only([
            'id',
            'name',
            'description',
            'url',
            'embed',
            'activity'
            ]);
        $resource = $request->has('id')
            ? $this->resources->update($input, $input['id'])
            : $this->resources->create($input);
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $resources = $this->resources->getAll();
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->resources->getOne($id);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $calendar = $this->resources->delete($id);
    }
}
