<?php

namespace App\Http\Controllers\Core\Interaction\Folksonomy;

use App\Repositories\Core\Interaction\FolksonomyDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class FolksonomyController extends Controller
{
    /**
     * [$folksonomies description]
     * @var [type]
     */
    protected $folksonomies;

    /**
     * /
     * @param FolksonomyDAO $folksonomies [description]
     */
    public function __construct(FolksonomyDAO $folksonomies)
    {
        $this->folksonomies = $folksonomies;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $folksonomies = $this->folksonomies->getFolksonomysPaginated(config('core.interaction.folksonomy.default_per_page'))->items();
        $res = [
            'status' => $folksonomies ? 'OK' : 'error',
            'result' => $folksonomies,
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
        $input = $request->only(['term_id', 'user_id', 'usertaggable_type', 'usertaggable_id']);
        if (isset($input['id'])) {
            $folksonomy = $this->folksonomies->create($input);
        } else {
            $folksonomy = $this->folksonomies->update($input);
        }
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'message' => trans('alerts.folksonomy.stored'),
            'result' => $folksonomy,
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
        $folksonomy = $this->folksonomies->findOrFail($id, true);
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'result' => $folksonomy,
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
        $folksonomy = $this->folksonomies->delete($id);
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'message' => trans("alerts.folksonomies.deleted"),
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
        $folksonomies = $this->folksonomies->deleteMany($var['ids']);
        $res = [
            'status' => $folksonomies ? 'OK' : 'error',
            'message' => trans("alerts.folksonomies.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteFolksonomyRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->folksonomies->delete($id);
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'message' => trans("alerts.folksonomies.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreFolksonomyRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->folksonomies->restore($id);
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'message' => trans("alerts.folksonomies.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkFolksonomyRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->folksonomies->mark($id, $status);
        $res = [
            'status' => $folksonomy ? 'OK' : 'error',
            'message' => trans("alerts.folksonomies.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $folksonomies = $this->folksonomies->getFolksonomysPaginated();
        $res = [
            'status' => $folksonomies ? 'OK' : 'error',
            'result' => $folksonomies,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $folksonomies = $this->folksonomies->getDeletedFolksonomysPaginated();
        $res = [
            'status' => $folksonomies ? 'OK' : 'error',
            'result' => $folksonomies,
        ];
        return response()->json($res);
    }
}
