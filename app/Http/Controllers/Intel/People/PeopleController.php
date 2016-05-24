
<?php

namespace App\Http\Controllers\Package\Name;

use App\Repositories\Package\NameDAO;

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
     * @param NameDAO $names [description]
     */
    public function __construct(NameDAO $names)
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
    public function index()
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
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function deleteMany(DeleteRequest $request)
    {
        $ids = $request->only('ids');
        $names = $this->names->deleteMany($var['ids']);
        $res = [
            'status' => $names ? 'OK' : 'error',
            'message' => trans("alerts.names.deleted"),
            'result' => ['ids' => $ids],
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

    /**
     * @param $id
     * @param RestoreNameRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->names->restore($id);
        $res = [
            'status' => $name ? 'OK' : 'error',
            'message' => trans("alerts.names.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkNameRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->names->mark($id, $status);
        $res = [
            'status' => $name ? 'OK' : 'error',
            'message' => trans("alerts.names.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $names = $this->names->getNamesPaginated();
        $res = [
            'status' => $names ? 'OK' : 'error',
            'result' => $names,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $names = $this->names->getDeletedNamesPaginated();
        $res = [
            'status' => $names ? 'OK' : 'error',
            'result' => $names,
        ];
        return response()->json($res);
    }
}
