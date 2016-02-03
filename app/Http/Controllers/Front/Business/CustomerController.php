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
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        if (isset($input['id'])) {
            $name = $this->names->create($input);
        } else {
            $name = $this->names->update($input);
        }
        $res = [
            'status' => $name ? 'OK' : 'error',
            'message' => trans('alerts.name.stored'),
            'result' => $name,
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

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $name = $this->names->delete($id);
        $res = [
            'status' => $name ? 'OK' : 'error',
            'message' => trans("alerts.names.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteNameRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->names->delete($id);
        $res = [
            'status' => $name ? 'OK' : 'error',
            'message' => trans("alerts.names.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }
}
