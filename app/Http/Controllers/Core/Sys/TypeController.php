<?php

namespace App\Http\Controllers\Core\Sys\Type;

use App\Repositories\Core\Sys\TypeDAO;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

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
    public function __construct(RestProcessor $rest, TypeDAO $types)
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
        $types = $this->types->getAll();
        return $this->rest->process($types);
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
            $type = $this->types->update($input, $request->get('pk'));
        } else {
            $type = $this->types->insert($input);
        }
        return $this->rest->process($type);
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $type = $this->types->getOne(['pk' => $pk]);
        return $this->rest->process($type);
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $type = $this->types->delete($pk);
        return $this->rest->process($type);
    }
}
