<?php

namespace App\Http\Controllers\Core\Sys\Config;

use App\Repositories\Core\Sys\ConfigRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ConfigController extends Controller
{
    /**
     * [$configs description]
     * @var [config]
     */
    protected $configs;

    /**
     * /
     * @param ConfigRepository $configs [description]
     */
    public function __construct(ConfigRepository $configs)
    {
        $this->configs = $configs;
    }

    /**
     * /
     * @return [config] [description]
     */
    public function app()
    {
        return view('core.sys.config');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [config]        [description]
     */
    public function index()
    {
        $configs = $this->configs->getConfigsPaginated(config('core.sys.config.default_per_page'))->items();
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'result' => $configs,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [config]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        if (isset($input['id'])) {
            $config = $this->configs->create($input);
        } else {
            $config = $this->configs->update($input);
        }
        $res = [
            'status' => $config ? 'OK' : 'error',
            'message' => trans('alerts.config.stored'),
            'result' => $config,
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
        $config = $this->configs->findOrFail($id, true);
        $res = [
            'status' => $config ? 'OK' : 'error',
            'result' => $config,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [config]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $config = $this->configs->delete($id);
        $res = [
            'status' => $config ? 'OK' : 'error',
            'message' => trans("alerts.configs.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [config]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function deleteMany(DeleteRequest $request)
    {
        $ids = $request->only('ids');
        $configs = $this->configs->deleteMany($var['ids']);
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'message' => trans("alerts.configs.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteConfigRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->configs->delete($id);
        $res = [
            'status' => $config ? 'OK' : 'error',
            'message' => trans("alerts.configs.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreConfigRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->configs->restore($id);
        $res = [
            'status' => $config ? 'OK' : 'error',
            'message' => trans("alerts.configs.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkConfigRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->configs->mark($id, $status);
        $res = [
            'status' => $config ? 'OK' : 'error',
            'message' => trans("alerts.configs.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $configs = $this->configs->getConfigsPaginated(25);
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'result' => $configs,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $configs = $this->configs->getDeletedConfigsPaginated(25);
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'result' => $configs,
        ];
        return response()->json($res);
    }
}
