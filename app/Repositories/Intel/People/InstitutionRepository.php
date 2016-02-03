<?php
namespace App\Repositories\Package\Institution;

use App\Models\Package\Institution\Institution;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentInstitutionRepository
 * @package App\Repositories\Institution
 */
class InstitutionRepository extends Repository
{
    use trait;

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
        return Institution::onlyTrashed()->paginate($per_page);
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

        $institution = $this->findOrFail($id);
        if ($institution->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this institution. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $institution = $this->findOrFail($id, true);

        try {
            $institution->forceDelete();
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
        $institution = $this->findOrFail($id);

        if ($institution->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this institution. Please try again.");
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

        $institution = $this->findOrFail($id);
        $institution->status = $status;

        if ($institution->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this institution. Please try again.");
    }
}
