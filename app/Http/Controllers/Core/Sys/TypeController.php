<?php

namespace App\Http\Controllers\Core\Sys\Type;

use App\Repositories\Core\Sys\TypeDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class TypeController extends Controller
{
    /**
     * [$types description]
     * @var [type]
     */
    protected $types;

    /**
     * /
     * @param TypeDAO $types [description]
     */
    public function __construct(TypeDAO $types)
    {
        $this->types = $types;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.sys.type');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $types = $this->types->getAll();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $pk = $request->only('id');
        $input = $request->only(['class', 'name']);
        if (isset($pk)) {
            $type = $this->types->create($input);
        } else {
            $type = $this->types->update($input, $pk['id']);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $type = $this->types->getOne(['pk' => $pk]);
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
    }
}
