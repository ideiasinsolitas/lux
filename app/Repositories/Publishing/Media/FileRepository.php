<?php
namespace App\Repositories\Package\File;

use App\Models\Package\File\File;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentFileRepository
 * @package App\Repositories\File
 */
class FileRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\File\File';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return File::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getFilesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return File::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedFilesPaginated($per_page = 20)
    {
        return File::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllFiles($order_by = 'id', $sort = 'asc')
    {
        return File::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws FileNeedsRolesException
     */
    public function create($input)
    {
        $file = File::create($input);

        if ($file->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this file. Please try again.');
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
        $file = $this->findOrFail($id);

        if ($file->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this file. Please try again.');
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

        $file = $this->findOrFail($id);
        if ($file->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this file. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $file = $this->findOrFail($id, true);

        try {
            $file->forceDelete();
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
        $file = $this->findOrFail($id);

        if ($file->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this file. Please try again.");
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

        $file = $this->findOrFail($id);
        $file->status = $status;

        if ($file->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this file. Please try again.");
    }
}
