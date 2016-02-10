<?php
namespace App\Repositories\Package\Shop;

use App\Models\Package\Shop\Shop;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentShopRepository
 * @package App\Repositories\Shop
 */
class ShopRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Shop\Shop';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Shop::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getShopsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Shop::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedShopsPaginated($per_page = 20)
    {
        return Shop::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllShops($order_by = 'id', $sort = 'asc')
    {
        return Shop::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ShopNeedsRolesException
     */
    public function create($input)
    {
        $shop = Shop::create($input);

        if ($shop->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this shop. Please try again.');
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
        $shop = $this->findOrFail($id);

        if ($shop->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this shop. Please try again.');
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

        $shop = $this->findOrFail($id);
        if ($shop->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this shop. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $shop = $this->findOrFail($id, true);

        try {
            $shop->forceDelete();
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
        $shop = $this->findOrFail($id);

        if ($shop->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this shop. Please try again.");
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

        $shop = $this->findOrFail($id);
        $shop->status = $status;

        if ($shop->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this shop. Please try again.");
    }
}
