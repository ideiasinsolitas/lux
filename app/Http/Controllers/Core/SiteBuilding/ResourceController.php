<?php

namespace App\Http\Controllers\Core\Sys\Resource;

use App\Repositories\Core\Sys\ResourceDAO;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class ResourceController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$resources description]
     * @var [type]
     */
    protected $resources;

    /**
     * /
     * @param ResourceDAO $resources [description]
     */
    public function __construct(RestProcessor $rest, ResourceDAO $resources)
    {
        $this->rest = $rest;
        $this->resources = $resources;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
            'name',
            'description',
            'url',
            'embed',
            'activity'
            ]);
        if ($request->has('pk')) {
            $input['modified'] = Carbon::now();
            $this->resources->update($input, $request->get('pk'));
        } else {
            $input['node_id'] = $this->resources->createNode();
            $input['created'] = Carbon::now();
            $this->resources->insert($input);
        }
        return $this->rest->process($resource);
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $resources = $this->resources->getAll();
        return $this->rest->process($resources);
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $resource = $this->resources->getOne(['pk' => $pk]);
        return $this->rest->process($resource);
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $resource = $this->resources->delete($pk);
        return $this->rest->process($resource);
    }
}
