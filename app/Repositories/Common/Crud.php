<?php

namespace App\Repositories\Core\GeoLocation;

use App\Exceptions\GeneralException;

/**
 * Class EloquentPlaceRepository
 * @package App\Repositories\Place
 */
trait Crud
{
    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        $model = $this->model;
        $entity = $model::find($id);

        if (! is_null($entity)) {
            return $entity;
        }

        throw new GeneralException('That ' . strtolower($model) . ' does not exist.');
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPaginated($per_page = 20, $order_by = 'created_at', $sort = 'desc')
    {
        $model = $this->model;
        return $model::orderBy($order_by, $sort)->simplePaginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPaginated($per_page = 20)
    {
        $model = $this->model;
        return $model::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAll($order_by = 'created_at', $sort = 'desc')
    {
        $model = $this->model;
        return $model::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws PlaceNeedsRolesException
     */
    public function create($input)
    {
        $model = $this->model;
        $entity = $model::create($input);

        if ($entity->save()) {
            return $entity;
        }
        throw new GeneralException("There was a problem creating this place. Please try again.");
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
        $entity = $this->findOrFail($id);

        if ($entity->update($input, $id)) {
            return true;
        }
        throw new GeneralException("There was a problem updating this place. Please try again.");
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $entity = $this->findOrFail($id);

        if ($entity->delete()) {
            return true;
        }
        throw new GeneralException("There was a problem deleting this place. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function deleteMany($ids)
    {
        $entity = $model::whereIn('id', $ids)->delete();

        if ($entity) {
            return true;
        }
        throw new GeneralException("There was a problem deleting this place. Please try again.");
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $entity = $this->findOrFail($id);

        if ($entity->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this place. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        $entity = $this->findOrFail($id);
        $entity->status = $status;

        if ($entity->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this place. Please try again.");
    }
}
