<?php
namespace App\Repositories\Core\Sys\Config;

use App\Models\Core\Sys\Config\Config;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentConfigRepository
 * @package App\Repositories\Config
 */
class ConfigRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->modelPath = 'App\Models\Core\Sys\Config\Config';
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getConfigsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Config::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedConfigsPaginated($per_page = 20)
    {
        return Config::where('activity', '0')->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllConfigs($order_by = 'id', $sort = 'asc')
    {
        return Config::orderBy($order_by, $sort)->get();
    }

    public function create($input)
    {
        return DB::table('core_config')
            ->insertGetId($input);
    }

    public function update($input)
    {
        return DB::table('core_config')
            ->update($input)
            ->where('id', $input['id']);
    }
}
