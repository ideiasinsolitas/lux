<?php
namespace App\Repositories\Package\Institution;

use App\Models\Package\Institution\Institution;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentInstitutionRepository
 * @package App\Repositories\Institution
 */
class InstitutionRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Institution\Institution';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Institution::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getInstitutionsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Institution::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedInstitutionsPaginated($per_page = 20)
    {
        return Institution::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllInstitutions($order_by = 'id', $sort = 'asc')
    {
        return Institution::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws InstitutionNeedsRolesException
     */
    public function create($input)
    {
        $institution = Institution::create($input);

        if ($institution->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this institution. Please try again.');
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
        $institution = $this->findOrFail($id);

        if ($institution->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this institution. Please try again.');
    }
}
