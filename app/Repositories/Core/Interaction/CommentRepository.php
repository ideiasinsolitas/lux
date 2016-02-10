<?php
namespace App\Repositories\Core\Interaction\Comment;

use App\Models\Core\Interaction\Comment\Comment;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentCommentRepository
 * @package App\Repositories\Comment
 */
class CommentRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->modelPath = 'App\Models\Core\Interaction\Comment';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Comment::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getCommentsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Comment::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedCommentsPaginated($per_page = 20)
    {
        return Comment::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllComments($order_by = 'id', $sort = 'asc')
    {
        return Comment::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws CommentNeedsRolesException
     */
    public function create($input)
    {
        $comment = Comment::create($input);

        if ($comment->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this comment. Please try again.');
    }
}
