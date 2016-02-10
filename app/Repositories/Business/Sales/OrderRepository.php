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
        return Order::where('activity', 0)->paginate($per_page);
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






    public function orderDetail($order_id)
    {
        $sql = "SELECT * FROM itens INNER JOIN products ON products.product_id=itens.product_id WHERE itens.order_id=:order_id";
        $itens = $this->db->run($sql, array('order_id' => $order_id));
        $this->setDado('itens', $itens);

        $sql = "SELECT * FROM orders WHERE order_id=:order_id";
        $order = $this->db->run($sql, array('order_id' => $order_id));

        $sql = "SELECT * FROM customers WHERE customer_id=:customer_id";
        $customer = $this->db->run($sql, array('customer_id' => $order[0]['customer_id']));

        $data = array('customer' => $customer[0], 'order' => $order[0]);
        return $data;
    }

    public function getProducts($order_id)
    {
        $sql = "SELECT product_id FROM itens WHERE order_id=:order_id";

        $itens = $this->db->run($sql, array('order_id' => $order_id));

        $list = implode(',', $itens);
        $sql = "SELECT * FROM products WHERE product_id IN ($list)";
        $products = $this->db->run($sql);

        return $products;
    }
}
