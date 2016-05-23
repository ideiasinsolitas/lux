<?php
namespace App\Repositories\Business\Sales;

use App\Models\Business\Sales\Invoice;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentInvoiceRepository
 * @package App\Repositories\Invoice
 */
class InvoiceRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Sales\Invoice';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Invoice::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getInvoicesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Invoice::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedInvoicesPaginated($per_page = 20)
    {
        return Invoice::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllInvoices($order_by = 'id', $sort = 'asc')
    {
        return Invoice::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws InvoiceNeedsRolesException
     */
    public function create($input)
    {
        $invoice = Invoice::create($input);

        if ($invoice->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this invoice. Please try again.');
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
        $invoice = $this->findOrFail($id);

        if ($invoice->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this invoice. Please try again.');
    }
}
