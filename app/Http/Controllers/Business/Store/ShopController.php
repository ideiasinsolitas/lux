<?php

namespace App\Http\Controllers\Business\Store;

use App\DAL\Business\Store\ShopDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class ShopController extends Controller
{
    /**
     * [$shops description]
     * @var [type]
     */
    protected $shops;

    /**
     * /
     * @param ShopDAO $shops [description]
     */
    public function __construct(ShopDAO $shops)
    {
        $this->shops = $shops;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.store.shop');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $shops = $this->shops->getShopsPaginated(config('business.store.shop.default_per_page'))->items();
        $res = [
            'status' => $shops ? 'OK' : 'error',
            'result' => $shops,
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
        $input = $request->only(['id', 'node_id', 'seller_id', 'shop', 'description']);
        if (isset($input['id'])) {
            $shop = $this->shops->create($input);
        } else {
            $shop = $this->shops->update($input);
        }
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'message' => trans('alerts.shop.stored'),
            'result' => $shop,
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
        $shop = $this->shops->findOrFail($id, true);
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'result' => $shop,
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
        $shop = $this->shops->delete($id);
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'message' => trans("alerts.shops.deleted"),
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
        $shops = $this->shops->deleteMany($var['ids']);
        $res = [
            'status' => $shops ? 'OK' : 'error',
            'message' => trans("alerts.shops.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteShopRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->shops->delete($id);
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'message' => trans("alerts.shops.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreShopRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->shops->restore($id);
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'message' => trans("alerts.shops.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkShopRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->shops->mark($id, $status);
        $res = [
            'status' => $shop ? 'OK' : 'error',
            'message' => trans("alerts.shops.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $shops = $this->shops->getShopsPaginated();
        $res = [
            'status' => $shops ? 'OK' : 'error',
            'result' => $shops,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $shops = $this->shops->getDeletedShopsPaginated();
        $res = [
            'status' => $shops ? 'OK' : 'error',
            'result' => $shops,
        ];
        return response()->json($res);
    }
}
