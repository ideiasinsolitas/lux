<?php
namespace App\Repositories\Package\Product;

use App\Models\Package\Product\Product;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentProductRepository
 * @package App\Repositories\Product
 */
class ProductRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Product\Product';
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
        return Product::onlyTrashed()->paginate($per_page);
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

        $product = $this->findOrFail($id);
        if ($product->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this name. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $product = $this->findOrFail($id, true);

        try {
            $product->forceDelete();
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
        $product = $this->findOrFail($id);

        if ($product->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this name. Please try again.");
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

        $product = $this->findOrFail($id);
        $product->status = $status;

        if ($product->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this name. Please try again.");
    }
}
