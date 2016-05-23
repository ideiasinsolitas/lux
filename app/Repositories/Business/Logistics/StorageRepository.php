<?php
namespace App\Repositories\Business\Logistics;

use App\Models\Business\Logistics\Storage;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentStorageRepository
 * @package App\Repositories\Storage
 */
class StorageRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Logistics\Storage';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Storage::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getStoragesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Storage::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedStoragesPaginated($per_page = 20)
    {
        return Storage::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllStorages($order_by = 'id', $sort = 'asc')
    {
        return Storage::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws StorageNeedsRolesException
     */
    public function create($input)
    {
        $storage = Storage::create($input);

        if ($storage->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this storage. Please try again.');
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
        $storage = $this->findOrFail($id);

        if ($storage->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this storage. Please try again.');
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

        $storage = $this->findOrFail($id);
        if ($storage->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this storage. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $storage = $this->findOrFail($id, true);

        try {
            $storage->forceDelete();
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
        $storage = $this->findOrFail($id);

        if ($storage->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this storage. Please try again.");
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

        $storage = $this->findOrFail($id);
        $storage->status = $status;

        if ($storage->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this storage. Please try again.");
    }
}
