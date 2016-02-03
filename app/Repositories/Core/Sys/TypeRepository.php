<?php
namespace App\Repositories\Core\Sys\Type;

use App\Models\Core\Sys\Type\Type;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTypeRepository
 * @package App\Repositories\Type
 */
class TypeRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Sys\Type\Type';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Type::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTypesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Type::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTypesPaginated($per_page = 20)
    {
        return Type::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTypes($order_by = 'id', $sort = 'asc')
    {
        return Type::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws TypeNeedsRolesException
     */
    public function create($input)
    {
        $type = Type::create($input);

        if ($type->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this type. Please try again.');
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
        $type = $this->findOrFail($id);

        if ($type->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this type. Please try again.');
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

        $type = $this->findOrFail($id);
        if ($type->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this type. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $type = $this->findOrFail($id, true);

        try {
            $type->forceDelete();
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
        $type = $this->findOrFail($id);

        if ($type->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this type. Please try again.");
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

        $type = $this->findOrFail($id);
        $type->status = $status;

        if ($type->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this type. Please try again.");
    }
}
