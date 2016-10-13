<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\UserManagement\Contracts\UserDataMapperContract;
use App\DAL\Business\UserManagement\User;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class UserController extends Controller
{
    /**
     * [$mapper description]
     * @var [user]
     */
    protected $mapper;

    /**
     * /
     * @param UserDAO $mapper [description]
     */
    public function __construct(UserDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [user]        [description]
     */
    public function index()
    {
        $users = $this->mapper->fetchAll();
        return response($users, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [user]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = User::hydrate($input);
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
        $user = $this->mapper->fetchById($pk);
        return response($user->toArray(), 200);
    }
}
