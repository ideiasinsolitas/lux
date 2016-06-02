<?php

namespace App\Http\Controllers\Core\Sys\Resource;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Sys\Contracts\ResourceDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\Rest\RestProcessorContract;

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
    public function __construct(RestProcessorContract $rest, ResourceDAOContract $resources)
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
            $this->resources->update($input, (int) $request->get('pk'));
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
        $resource = $this->resources->getOne(['pk' => (int) $pk]);
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
        $resource = $this->resources->update(['activity' => 0, 'deleted' => Carbon::now()], (int) $pk);
        return $this->rest->process($resource);
    }
}
