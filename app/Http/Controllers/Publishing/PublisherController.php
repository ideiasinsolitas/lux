<?php

namespace App\Http\Controllers\Publishing;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Publishing\ContentManagement\Contracts\PublisherDataMapperContract;
use App\DAL\Publishing\ContentManagement\Publisher;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class PublisherController extends Controller
{
    /**
     * [$mapper description]
     * @var [publisher]
     */
    protected $mapper;

    /**
     * /
     * @param PublisherDAO $mapper [description]
     */
    public function __construct(PublisherDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [publisher]        [description]
     */
    public function index()
    {
        $publishers = $this->mapper->fetchAll();
        return response($publishers, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [publisher]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Publisher::hydrate($input);
        $unitOfWork = new UnitOfWork($this->mapper, new ObjectStorage);
        try {
            $unitOfWork->register($entity)->commit();
            $entity->setState("CLEAN");
            return response($entity, 200);
        } catch (Exception $e) {
            $unitOfWork->rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $publisher = $this->mapper->fetchById($pk);
        return response($publisher->toArray(), 200);
    }
}
