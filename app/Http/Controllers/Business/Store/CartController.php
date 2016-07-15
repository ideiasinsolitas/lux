<?php

namespace App\Http\Controllers\Business\Store;

use App\DAL\Business\Store\CartDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class CartController extends Controller
{
    /**
     * [$carts description]
     * @var [type]
     */
    protected $carts;

    /**
     * /
     * @param CartDAO $carts [description]
     */
    public function __construct(CartDAO $carts)
    {
        $this->carts = $carts;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.store.cart');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $carts = $this->carts->getCartsPaginated(config('business.store.cart.default_per_page'))->items();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'customer_id', 'product_id', 'quantity']);
        if (isset($input['id'])) {
            $cart = $this->carts->create($input);
        } else {
            $cart = $this->carts->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $cart = $this->carts->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $cart = $this->carts->delete($id);
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
        $carts = $this->carts->deleteMany($var['ids']);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteCartRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->carts->delete($id);
    }

    /**
     * @param $id
     * @param RestoreCartRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->carts->restore($id);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkCartRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->carts->mark($id, $status);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $carts = $this->carts->getCartsPaginated();
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $carts = $this->carts->getDeletedCartsPaginated();
    }
}
