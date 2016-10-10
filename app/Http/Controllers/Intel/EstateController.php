<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\EstateManagement\Contracts\EstateDataMapperContract;
use App\DAL\Business\EstateManagement\Estate;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class EstateController extends Controller
{
    /**
     * [$mapper description]
     * @var [estate]
     */
    protected $mapper;

    /**
     * /
     * @param EstateDAO $mapper [description]
     */
    public function __construct(EstateDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [estate]        [description]
     */
    public function index()
    {
        $estates = $this->mapper->fetchAll();
        return response($estates, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [estate]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Estate::hydrate($input);
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
        $estate = $this->mapper->fetchById($pk);
        return response($estate->toArray(), 200);
    }
}
