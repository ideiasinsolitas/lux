<?php

namespace App\Http\Controllers\Publishing;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\MagazineManagement\Contracts\MagazineDataMapperContract;
use App\DAL\Business\MagazineManagement\Magazine;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class MagazineController extends Controller
{
    /**
     * [$mapper description]
     * @var [magazine]
     */
    protected $mapper;

    /**
     * /
     * @param MagazineDAO $mapper [description]
     */
    public function __construct(MagazineDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [magazine]        [description]
     */
    public function index()
    {
        $magazines = $this->mapper->fetchAll();
        return response($magazines, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [magazine]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Magazine::hydrate($input);
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
        $magazine = $this->mapper->fetchById($pk);
        return response($magazine->toArray(), 200);
    }
}
