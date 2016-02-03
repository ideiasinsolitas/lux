<?php
namespace App\Repositories\Core\Interaction\Folksonomy;

use App\Models\Core\Interaction\Folksonomy\Folksonomy;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentFolksonomyRepository
 * @package App\Repositories\Folksonomy
 */
class FolksonomyRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Interaction\Folksonomy\Folksonomy';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Folksonomy::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getFolksonomysPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Folksonomy::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedFolksonomysPaginated($per_page = 20)
    {
        return Folksonomy::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllFolksonomys($order_by = 'id', $sort = 'asc')
    {
        return Folksonomy::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws FolksonomyNeedsRolesException
     */
    public function create($input)
    {
        $folksonomy = Folksonomy::create($input);

        if ($folksonomy->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this tag. Please try again.');
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
        $folksonomy = $this->findOrFail($id);

        if ($folksonomy->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this tag. Please try again.');
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

        $folksonomy = $this->findOrFail($id);
        if ($folksonomy->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this tag. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $folksonomy = $this->findOrFail($id, true);

        try {
            $folksonomy->forceDelete();
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
        $folksonomy = $this->findOrFail($id);

        if ($folksonomy->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this tag. Please try again.");
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

        $folksonomy = $this->findOrFail($id);
        $folksonomy->status = $status;

        if ($folksonomy->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this tag. Please try again.");
    }
}
