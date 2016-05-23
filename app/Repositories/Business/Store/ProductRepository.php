<?php
namespace App\Repositories\Business\Store;

use App\Models\Business\Store\Product;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentProductRepository
 * @package App\Repositories\Product
 */
class ProductRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Store\Product';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getProductsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Product::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedProductsPaginated($per_page = 20)
    {
        return Product::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllProducts($order_by = 'id', $sort = 'asc')
    {
        return Product::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ProductNeedsRolesException
     */
    public function create($input)
    {
        $product = Product::create($input);

        if ($product->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this name. Please try again.');
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
        $product = $this->findOrFail($id);

        if ($product->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this name. Please try again.');
    }
}
