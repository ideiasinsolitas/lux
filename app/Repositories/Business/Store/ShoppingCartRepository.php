<?php
namespace App\Repositories\Package\ShoppingCart;

use App\Models\Package\ShoppingCart\ShoppingCart;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentShoppingCartRepository
 * @package App\Repositories\ShoppingCart
 */
class ShoppingCartRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\ShoppingCart\ShoppingCart';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return ShoppingCart::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getShoppingCartsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return ShoppingCart::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedShoppingCartsPaginated($per_page = 20)
    {
        return ShoppingCart::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllShoppingCarts($order_by = 'id', $sort = 'asc')
    {
        return ShoppingCart::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ShoppingCartNeedsRolesException
     */
    public function create($input)
    {
        $cart = ShoppingCart::create($input);

        if ($cart->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this shopping cart. Please try again.');
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
        $cart = $this->findOrFail($id);

        if ($cart->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this shopping cart. Please try again.');
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

        $cart = $this->findOrFail($id);
        if ($cart->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this shopping cart. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $cart = $this->findOrFail($id, true);

        try {
            $cart->forceDelete();
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
        $cart = $this->findOrFail($id);

        if ($cart->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this shopping cart. Please try again.");
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

        $cart = $this->findOrFail($id);
        $cart->status = $status;

        if ($cart->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this shopping cart. Please try again.");
    }
}
