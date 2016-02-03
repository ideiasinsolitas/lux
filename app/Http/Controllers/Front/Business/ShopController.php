<?php

namespace App\Http\Controllers\Package\Name;

use App\Repositories\Package\NameRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class NameController extends Controller
{
    /**
     * [$names description]
     * @var [type]
     */
    protected $names;

    /**
     * /
     * @param NameRepository $names [description]
     */
    public function __construct(NameRepository $names)
    {
        $this->names = $names;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('package.name');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $names = $this->names->getNamesPaginated(config('package.name.default_per_page'))->items();
        $res = [
            'status' => $names ? 'OK' : 'error',
            'result' => $names,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $name = $this->names->findOrFail($id, true);
        $res = [
            'status' => $name ? 'OK' : 'error',
            'result' => $name,
        ];
        return response()->json($res);
    }
}
