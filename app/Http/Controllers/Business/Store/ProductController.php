<?php

namespace App\Http\Controllers\Business\Store;

use App\DAL\Business\Store\ProductDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class ProductController extends Controller
{
    /**
     * [$products description]
     * @var [type]
     */
    protected $products;

    /**
     * /
     * @param ProductDAO $products [description]
     */
    public function __construct(ProductDAO $products)
    {
        $this->products = $products;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.store.product');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $products = $this->products->getProductsPaginated(config('business.store.product.default_per_page'))->items();
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
            'node_id',
            'store_id',
            'in_stock',
            'price',
            'weight',
            'height',
            'width',
            'depth',
            'activity'
            ]);
        if (isset($input['id'])) {
            $product = $this->products->create($input);
        } else {
            $product = $this->products->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->products->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $product = $this->products->delete($id);
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
        $products = $this->products->deleteMany($var['ids']);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteProductRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->products->delete($id);
    }

    /**
     * @param $id
     * @param RestoreProductRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->products->restore($id);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkProductRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->products->mark($id, $status);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $products = $this->products->getProductsPaginated();
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $products = $this->products->getDeletedProductsPaginated();
    }
}
