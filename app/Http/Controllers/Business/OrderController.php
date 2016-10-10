<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\OrderManagement\Contracts\OrderDataMapperContract;
use App\DAL\Business\OrderManagement\Order;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class OrderController extends Controller
{
    /**
     * [$mapper description]
     * @var [order]
     */
    protected $mapper;

    /**
     * /
     * @param OrderDAO $mapper [description]
     */
    public function __construct(OrderDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [order]        [description]
     */
    public function index()
    {
        $orders = $this->mapper->fetchAll();
        return response($orders, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [order]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Order::hydrate($input);
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
        $order = $this->mapper->fetchById($pk);
        return response($order->toArray(), 200);
    }
}
