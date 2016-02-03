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
        $this->model = 'App\Models\Core\Sys\Config\Config';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Config::findOrFail($id);
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
        return Config::onlyTrashed()->paginate($per_page);
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

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ConfigNeedsRolesException
     */
    public function create($input)
    {
        $config = Config::create($input);

        if ($config->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this config. Please try again.');
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $config = $this->findOrFail($id);

        if ($config->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this config. Please try again.');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            throw new GeneralException("You can not delete yourself.");
        }

        $config = $this->findOrFail($id);
        if ($config->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this config. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $config = $this->findOrFail($id, true);

        try {
            $config->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $config = $this->findOrFail($id);

        if ($config->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this config. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if (auth()->id() == $id && ($status == 0 || $status == 2)) {
            throw new GeneralException("You can not do that to yourself.");
        }

        $config = $this->findOrFail($id);
        $config->status = $status;

        if ($config->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this config. Please try again.");
    }
}
