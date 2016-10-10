<?php

namespace App\Http\Controllers\Publishing;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;

use App\DAL\Business\BlogManagement\Contracts\BlogDataMapperContract;
use App\DAL\Business\BlogManagement\Blog;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class BlogController extends Controller
{
    /**
     * [$mapper description]
     * @var [blog]
     */
    protected $mapper;

    /**
     * /
     * @param BlogDAO $mapper [description]
     */
    public function __construct(BlogDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [blog]        [description]
     */
    public function index()
    {
        $blogs = $this->mapper->fetchAll();
        return response($blogs, 200);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [blog]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Blog::hydrate($input);
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
        $blog = $this->mapper->fetchById($pk);
        return response($blog->toArray(), 200);
    }
}
