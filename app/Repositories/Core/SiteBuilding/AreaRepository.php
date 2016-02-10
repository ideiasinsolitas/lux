<?php
namespace App\Repositories\Core\SiteBuilding\Area;

use App\Models\Core\SiteBuilding\Area\Area;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentAreaRepository
 * @package App\Repositories\Area
 */
class AreaRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\SiteBuilding\Area';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Area::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getAreasPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Area::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedAreasPaginated($per_page = 20)
    {
        return Area::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllAreas($order_by = 'id', $sort = 'asc')
    {
        return Area::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws AreaNeedsRolesException
     */
    public function create($input)
    {
        $area = Area::create($input);

        if ($area->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this area. Please try again.');
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
        $area = $this->findOrFail($id);

        if ($area->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this area. Please try again.');
    }
}
