<?php

namespace App\Http\Controllers\Core\Sys\Config;

use App\Repositories\Core\Sys\ConfigDAO;

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
     * @param ConfigDAO $configs [description]
     */
    public function __construct(ConfigDAO $configs)
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
        $configs = $this->configs->getDefaultConfig();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [config]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'user', 'key', 'value', 'format', 'activity']);
        if (isset($input['id'])) {
            $config = $this->configs->create($input);
        } else {
            $config = $this->configs->update($input, $input['id']);
        }
    }

    /**
     * /
     * @param  [config]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $config = $this->configs->delete($pk);
    }

    /**
     * @param $pk
     * @param RestoreConfigRequest $request
     * @return mixed
     */
    public function restore($pk, UpdateRequest $request)
    {
        $config = $this->configs->restore($pk);
    }

    /**
     * @param $pk
     * @param $status
     * @param MarkConfigRequest $request
     * @return mixed
     */
    public function mark($pk, $status, UpdateRequest $request)
    {
        $config = $this->configs->mark($pk, $status);
    }
}
