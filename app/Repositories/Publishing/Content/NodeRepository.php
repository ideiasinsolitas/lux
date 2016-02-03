<?php
namespace App\Repositories\Package\Node;

use App\Models\Package\Node\Node;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentNodeRepository
 * @package App\Repositories\Node
 */
class NodeRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Node\Node';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Node::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getNodesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Node::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedNodesPaginated($per_page = 20)
    {
        return Node::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllNodes($order_by = 'id', $sort = 'asc')
    {
        return Node::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws NodeNeedsRolesException
     */
    public function create($input)
    {
        $node = Node::create($input);

        if ($node->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this node. Please try again.');
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
        $node = $this->findOrFail($id);

        if ($node->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this node. Please try again.');
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

        $node = $this->findOrFail($id);
        if ($node->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this node. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $node = $this->findOrFail($id, true);

        try {
            $node->forceDelete();
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
        $node = $this->findOrFail($id);

        if ($node->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this node. Please try again.");
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

        $node = $this->findOrFail($id);
        $node->status = $status;

        if ($node->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this node. Please try again.");
    }
}
