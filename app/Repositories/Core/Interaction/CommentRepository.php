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
        $this->model = 'App\Models\Core\Interaction\Comment\Comment';
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
        return Comment::onlyTrashed()->paginate($per_page);
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

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $comment = $this->findOrFail($id);

        if ($comment->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this comment. Please try again.');
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

        $comment = $this->findOrFail($id);
        if ($comment->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this comment. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $comment = $this->findOrFail($id, true);

        try {
            $comment->forceDelete();
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
        $comment = $this->findOrFail($id);

        if ($comment->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this comment. Please try again.");
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

        $comment = $this->findOrFail($id);
        $comment->status = $status;

        if ($comment->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this comment. Please try again.");
    }
}
