<?php
namespace App\Repositories\Core\SiteBuilding\Menu;

use App\Models\Core\SiteBuilding\Menu\Menu;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentMenuRepository
 * @package App\Repositories\Menu
 */
class MenuRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\SiteBuilding\Menu\Menu';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Menu::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getMenusPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Menu::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedMenusPaginated($per_page = 20)
    {
        return Menu::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllMenus($order_by = 'id', $sort = 'asc')
    {
        return Menu::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws MenuNeedsRolesException
     */
    public function create($input)
    {
        $menu = Menu::create($input);

        if ($menu->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this menu. Please try again.');
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
        $menu = $this->findOrFail($id);

        if ($menu->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this menu. Please try again.');
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

        $menu = $this->findOrFail($id);
        if ($menu->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this menu. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $menu = $this->findOrFail($id, true);

        try {
            $menu->forceDelete();
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
        $menu = $this->findOrFail($id);

        if ($menu->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this menu. Please try again.");
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

        $menu = $this->findOrFail($id);
        $menu->status = $status;

        if ($menu->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this menu. Please try again.");
    }
}
