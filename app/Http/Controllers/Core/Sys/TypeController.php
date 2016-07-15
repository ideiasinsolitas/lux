<?php

namespace App\Http\Controllers\Core\Sys;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Sys\Contracts\TypeDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\Rest\RestProcessorContract;

class TypeController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$types description]
     * @var [type]
     */
    protected $types;

    /**
     * /
     * @param TypeDAO $types [description]
     */
    public function __construct(RestProcessorContract $rest, TypeDAOContract $types)
    {
        $this->rest = $rest;
        $this->types = $types;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $types = $this->types->getAll(request()->get("filters"));
        return $types;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['class', 'name']);
        if ($request->has('pk')) {
            $type = $this->types->update($input, (int) $request->get('pk'));
        } else {
            $type = $this->types->insert($input);
        }
        return $type;
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $type = $this->types->getOne(['pk' => (int) $pk]);
        return $type;
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $type = $this->types->delete((int) $pk);
        return $type;
    }
}
