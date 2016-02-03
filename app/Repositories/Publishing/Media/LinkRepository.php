<?php
namespace App\Repositories\Package\Link;

use App\Models\Package\Link\Link;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentLinkRepository
 * @package App\Repositories\Link
 */
class LinkRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Link\Link';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Link::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getLinksPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Link::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedLinksPaginated($per_page = 20)
    {
        return Link::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllLinks($order_by = 'id', $sort = 'asc')
    {
        return Link::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws LinkNeedsRolesException
     */
    public function create($input)
    {
        $link = Link::create($input);

        if ($link->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this link. Please try again.');
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
        $link = $this->findOrFail($id);

        if ($link->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this link. Please try again.');
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

        $link = $this->findOrFail($id);
        if ($link->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this link. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $link = $this->findOrFail($id, true);

        try {
            $link->forceDelete();
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
        $link = $this->findOrFail($id);

        if ($link->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this link. Please try again.");
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

        $link = $this->findOrFail($id);
        $link->status = $status;

        if ($link->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this link. Please try again.");
    }
}
