<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\CalendarManagement\Contracts\CalendarDataMapperContract;
use App\DAL\Business\CalendarManagement\Calendar;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class CalendarController extends Controller
{
    /**
     * [$mapper description]
     * @var [calendar]
     */
    protected $mapper;

    /**
     * /
     * @param CalendarDAO $mapper [description]
     */
    public function __construct(CalendarDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [calendar]        [description]
     */
    public function index()
    {
        $calendars = $this->mapper->fetchAll();
        return response($calendars, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [calendar]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Calendar::hydrate($input);
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
        $calendar = $this->mapper->fetchById($pk);
        return response($calendar->toArray(), 200);
    }
}
