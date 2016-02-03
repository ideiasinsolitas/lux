<?php
namespace App\Repositories\Package\Order;

use App\Models\Package\Order\Order;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentOrderRepository
 * @package App\Repositories\Order
 */
class OrderRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Order\Order';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Order::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getOrdersPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Order::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedOrdersPaginated($per_page = 20)
    {
        return Order::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllOrders($order_by = 'id', $sort = 'asc')
    {
        return Order::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws OrderNeedsRolesException
     */
    public function create($input)
    {
        $order = Order::create($input);

        if ($order->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this order. Please try again.');
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
        $order = $this->findOrFail($id);

        if ($order->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this order. Please try again.');
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

        $order = $this->findOrFail($id);
        if ($order->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this order. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $order = $this->findOrFail($id, true);

        try {
            $order->forceDelete();
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
        $order = $this->findOrFail($id);

        if ($order->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this order. Please try again.");
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

        $order = $this->findOrFail($id);
        $order->status = $status;

        if ($order->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this order. Please try again.");
    }
}
