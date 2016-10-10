<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\ShopManagement\Contracts\ShopDataMapperContract;
use App\DAL\Business\ShopManagement\Shop;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ShopController extends Controller
{
    /**
     * [$mapper description]
     * @var [shop]
     */
    protected $mapper;

    /**
     * /
     * @param ShopDataMapperContract $mapper [description]
     */
    public function __construct(ShopDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [shop]        [description]
     */
    public function index()
    {
        $shops = $this->mapper->fetchAll();
        return response($shops, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [shop]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Shop::hydrate($input);
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
        $shop = $this->mapper->fetchById($pk);
        return response($shop->toArray(), 200);
    }
}
