<?php
namespace App\Repositories\Package\Estate;

use App\Models\Package\Estate\Estate;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentEstateRepository
 * @package App\Repositories\Estate
 */
class EstateRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Estate\Estate';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Estate::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getEstatesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Estate::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedEstatesPaginated($per_page = 20)
    {
        return Estate::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllEstates($order_by = 'id', $sort = 'asc')
    {
        return Estate::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws EstateNeedsRolesException
     */
    public function create($input)
    {
        $estate = Estate::create($input);

        if ($estate->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this estate. Please try again.');
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
        $estate = $this->findOrFail($id);

        if ($estate->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this estate. Please try again.');
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

        $estate = $this->findOrFail($id);
        if ($estate->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this estate. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $estate = $this->findOrFail($id, true);

        try {
            $estate->forceDelete();
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
        $estate = $this->findOrFail($id);

        if ($estate->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this estate. Please try again.");
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

        $estate = $this->findOrFail($id);
        $estate->status = $status;

        if ($estate->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this estate. Please try again.");
    }
}
