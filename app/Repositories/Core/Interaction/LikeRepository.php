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
        $this->modelPath = 'App\Models\Core\Interaction\Like';
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
        return Like::where('activity', 0)->paginate($per_page);
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
}
