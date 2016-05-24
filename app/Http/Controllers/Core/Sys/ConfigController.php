<?php

namespace App\Http\Controllers\Core\Sys\Config;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Repositories\Core\Sys\ConfigDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ConfigController extends Controller
{
    /**
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
use App\Http\Controllers\Controller;

use App\DAL\Core\Sys\Contracts\ConfigDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class ConfigController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;
    
    /**
<<<<<<< HEAD
=======
use App\Repositories\Core\Sys\ConfigRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ConfigController extends Controller
{
    /**
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
     * [$configs description]
     * @var [config]
     */
    protected $configs;

    /**
     * /
<<<<<<< HEAD
<<<<<<< HEAD
     * @param ConfigDAO $configs [description]
     */
    public function __construct(RestProcessor $rest, ConfigDAOContract $configs)
    {
        $this->rest = $rest;
=======
     * @param ConfigRepository $configs [description]
     */
    public function __construct(ConfigRepository $configs)
    {
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
     * @param ConfigDAO $configs [description]
     */
<<<<<<< HEAD
    public function __construct(ConfigDAO $configs)
    {
=======
    public function __construct(RestProcessor $rest, ConfigDAOContract $configs)
    {
        $this->rest = $rest;
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $this->configs = $configs;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
     * /
     * @return [config] [description]
     */
    public function app()
    {
        return view('core.sys.config');
    }

    /**
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [config]        [description]
     */
    public function index()
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $configs = $this->configs->getDefaultConfig();
        return $this->rest->process($configs);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $configs = $this->configs->getConfigsPaginated(config('core.sys.config.default_per_page'))->items();
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'result' => $configs,
        ];
        return response()->json($res);
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
        $configs = $this->configs->getDefaultConfig();
        return $this->rest->process($configs);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [config]                [description]
     */
    public function store(StoreRequest $request)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $input = $request->only(['user', 'key', 'value', 'format', 'activity']);
        if ($request->has('pk')) {
            $config = $this->configs->update($input, (int) $request->get('pk'));
        } else {
            $config = $this->configs->insert($input);
        }
        return $this->rest->process($config);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $input = $request->only(['id', 'key', 'value', 'format', 'activity']);
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
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
        $input = $request->only(['user', 'key', 'value', 'format', 'activity']);
        if ($request->has('pk')) {
            $config = $this->configs->update($input, (int) $request->get('pk'));
        } else {
            $config = $this->configs->insert($input);
        }
        return $this->rest->process($config);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }

    /**
     * /
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  [config]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $config = $this->configs->update(['activity' => 0], (int) $pk);
        return $this->rest->process($config);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
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
        $configs = $this->configs->getConfigsPaginated();
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
        $configs = $this->configs->getDeletedConfigsPaginated();
        $res = [
            'status' => $configs ? 'OK' : 'error',
            'result' => $configs,
        ];
        return response()->json($res);
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
     * @param  [config]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $config = $this->configs->update(['activity' => 0], (int) $pk);
        return $this->rest->process($config);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }
}
