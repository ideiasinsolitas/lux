<?php

namespace App\Http\Controllers\Package\Name;

use App\DAL\Package\NameDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class NameController extends Controller
{
    /**
     * [$names description]
     * @var [type]
     */
    protected $names;

    /**
     * /
     * @param NameDAO $names [description]
     */
    public function __construct(NameDAO $names)
    {
        $this->names = $names;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('package.name');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $names = $this->names->getNamesPaginated(config('package.name.default_per_page'))->items();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
            'id',
            'customer_id',
            'seller_id',
            'invoice_id',
            'payment_method',
            'shipping_method',
            'price',
            'extra_cost',
            'shipping_cost',
            'total'
            ]);
        if (isset($input['id'])) {
            $name = $this->names->create($input);
        } else {
            $name = $this->names->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $name = $this->names->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $name = $this->names->delete($id);
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
        $names = $this->names->deleteMany($var['ids']);
    }

    /**
     * @param $id
     * @param RestoreNameRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->names->restore($id);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkNameRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->names->mark($id, $status);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $names = $this->names->getNamesPaginated();
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $names = $this->names->getDeletedNamesPaginated();
    }
}
