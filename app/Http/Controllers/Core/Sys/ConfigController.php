<?php

namespace App\Http\Controllers\Core\Sys\Config;

use App\Http\Controllers\Controller;

use App\DAL\Core\Sys\Contracts\ConfigDAOContract;
use App\Services\Rest\RestProcessorContract;

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
     * [$configs description]
     * @var [config]
     */
    protected $configs;

    /**
     * /
     * @param ConfigDAO $configs [description]
     */
    public function __construct(RestProcessorContract $rest, ConfigDAOContract $configs)
    {
        $this->rest = $rest;
        $this->configs = $configs;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [config]        [description]
     */
    public function index()
    {
        $configs = $this->configs->getDefaultConfig();
        return $this->rest->process($configs);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [config]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['user', 'key', 'value', 'format', 'activity']);
        if ($request->has('pk')) {
            $config = $this->configs->update($input, (int) $request->get('pk'));
        } else {
            $config = $this->configs->insert($input);
        }
        return $this->rest->process($config);
    }

    /**
     * /
     * @param  [config]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [config]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $config = $this->configs->update(['activity' => 0], (int) $pk);
        return $this->rest->process($config);
    }
}
