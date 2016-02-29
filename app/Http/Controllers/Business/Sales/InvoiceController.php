<?php

namespace App\Http\Controllers\Business\SalesInvoice;

use App\Repositories\Business\SalesInvoiceDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class InvoiceController extends Controller
{
    /**
     * [$invoices description]
     * @var [type]
     */
    protected $invoices;

    /**
     * /
     * @param InvoiceDAO $invoices [description]
     */
    public function __construct(InvoiceDAO $invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.sales.invoice');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $invoices = $this->invoices->getInvoicesPaginated(config('business.sales.invoice.default_per_page'))->items();
        $res = [
            'status' => $invoices ? 'OK' : 'error',
            'result' => $invoices,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'hours', 'rate', 'total', 'activity']);
        if (isset($input['id'])) {
            $invoice = $this->invoices->create($input);
        } else {
            $invoice = $this->invoices->update($input);
        }
        $res = [
            'status' => $invoice ? 'OK' : 'error',
            'message' => trans('alerts.invoice.stored'),
            'result' => $invoice,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $invoice = $this->invoices->findOrFail($id, true);
        $res = [
            'status' => $invoice ? 'OK' : 'error',
            'result' => $invoice,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $invoice = $this->invoices->delete($id);
        $res = [
            'status' => $invoice ? 'OK' : 'error',
            'message' => trans("alerts.invoices.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function deleteMany(DeleteRequest $request)
    {
        $ids = $request->only('ids');
        $invoices = $this->invoices->deleteMany($var['ids']);
        $res = [
            'status' => $invoices ? 'OK' : 'error',
            'message' => trans("alerts.invoices.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreInvoiceRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->invoices->restore($id);
        $res = [
            'status' => $invoice ? 'OK' : 'error',
            'message' => trans("alerts.invoices.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkInvoiceRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->invoices->mark($id, $status);
        $res = [
            'status' => $invoice ? 'OK' : 'error',
            'message' => trans("alerts.invoices.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $invoices = $this->invoices->getInvoicesPaginated();
        $res = [
            'status' => $invoices ? 'OK' : 'error',
            'result' => $invoices,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $invoices = $this->invoices->getDeletedInvoicesPaginated();
        $res = [
            'status' => $invoices ? 'OK' : 'error',
            'result' => $invoices,
        ];
        return response()->json($res);
    }
}
