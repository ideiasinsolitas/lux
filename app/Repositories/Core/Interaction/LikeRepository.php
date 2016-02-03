<?php
namespace App\Repositories\Core\Interaction\Like;

use App\Models\Core\Interaction\Like\Like;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentLikeRepository
 * @package App\Repositories\Like
 */
class LikeRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Interaction\Like\Like';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Like::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getLikesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Like::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedLikesPaginated($per_page = 20)
    {
        return Like::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllLikes($order_by = 'id', $sort = 'asc')
    {
        return Like::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws LikeNeedsRolesException
     */
    public function create($input)
    {
        $like = Like::create($input);

        if ($like->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this like. Please try again.');
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
        $like = $this->findOrFail($id);

        if ($like->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this like. Please try again.');
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

        $like = $this->findOrFail($id);
        if ($like->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this like. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $like = $this->findOrFail($id, true);

        try {
            $like->forceDelete();
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
        $like = $this->findOrFail($id);

        if ($like->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this like. Please try again.");
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

        $like = $this->findOrFail($id);
        $like->status = $status;

        if ($like->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this like. Please try again.");
    }
}
