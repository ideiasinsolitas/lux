<?php
namespace App\Repositories\Package\Invoice;

use App\Models\Package\Invoice\Invoice;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentInvoiceRepository
 * @package App\Repositories\Invoice
 */
class InvoiceRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Invoice\Invoice';
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
        return Invoice::onlyTrashed()->paginate($per_page);
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

        $invoice = $this->findOrFail($id);
        if ($invoice->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this invoice. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $invoice = $this->findOrFail($id, true);

        try {
            $invoice->forceDelete();
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
        $invoice = $this->findOrFail($id);

        if ($invoice->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this invoice. Please try again.");
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

        $invoice = $this->findOrFail($id);
        $invoice->status = $status;

        if ($invoice->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this invoice. Please try again.");
    }
}
