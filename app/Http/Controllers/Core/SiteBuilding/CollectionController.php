<?php

namespace App\Http\Controllers\Core\SiteBuilding;

use App\Repositories\Core\SiteBuilding\CollectionDAO;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class CollectionController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$collections description]
     * @var [type]
     */
    protected $collections;

    /**
     * /
     * @param CollectionDAO $collections [description]
     */
    public function __construct(RestProcessor $rest, CollectionDAO $collections)
    {
        $this->rest = $rest;
        $this->collections = $collections;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
            'collector_type',
            'collector_id',
            'node_id',
            'type_id',
            'order',
            'activity'
        ]);
        if ($request->has('pk')) {
            $input['modified'] = Carbon::now();
            $this->collections->update($input, $request->get('pk'));
        } else {
            $input['node_id'] = $this->collections->createNode();
            $input['created'] = Carbon::now();
            $this->collections->insert($input);
        }
        return $this->rest->process($collection);
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $collections = $this->collections->getAll();
        return $this->rest->process($collections);
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $collection = $this->collections->getOne(['pk' => $pk]);
        return $this->rest->process($collection);
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $collection = $this->collections->update(['activity' => 0, 'deleted' => Carbon::now()], $pk);
        return $this->rest->process($collection);
    }
}
