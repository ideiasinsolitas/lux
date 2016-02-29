<?php

namespace App\Http\Controllers\Core\SiteBuilding\Block;

use App\Repositories\Core\SiteBuilding\BlockDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class BlockController extends Controller
{
    /**
     * [$blocks description]
     * @var [type]
     */
    protected $blocks;

    /**
     * /
     * @param BlockDAO $blocks [description]
     */
    public function __construct(BlockDAO $blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.site_building.block');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $blocks = $this->blocks->getBlocksPaginated(config('core.site_building.block.default_per_page'))->items();
        $res = [
            'status' => $blocks ? 'OK' : 'error',
            'result' => $blocks,
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
        $input = $request->only(['id', 'area_id', 'name']);
        if (isset($input['id'])) {
            $block = $this->blocks->create($input);
        } else {
            $block = $this->blocks->update($input);
        }
        $res = [
            'status' => $block ? 'OK' : 'error',
            'message' => trans('alerts.block.stored'),
            'result' => $block,
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
        $block = $this->blocks->findOrFail($id, true);
        $res = [
            'status' => $block ? 'OK' : 'error',
            'result' => $block,
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
        $block = $this->blocks->delete($id);
        $res = [
            'status' => $block ? 'OK' : 'error',
            'message' => trans("alerts.blocks.deleted"),
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
        $blocks = $this->blocks->deleteMany($var['ids']);
        $res = [
            'status' => $blocks ? 'OK' : 'error',
            'message' => trans("alerts.blocks.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteBlockRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->blocks->delete($id);
        $res = [
            'status' => $block ? 'OK' : 'error',
            'message' => trans("alerts.blocks.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreBlockRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->blocks->restore($id);
        $res = [
            'status' => $block ? 'OK' : 'error',
            'message' => trans("alerts.blocks.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkBlockRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->blocks->mark($id, $status);
        $res = [
            'status' => $block ? 'OK' : 'error',
            'message' => trans("alerts.blocks.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $blocks = $this->blocks->getBlocksPaginated();
        $res = [
            'status' => $blocks ? 'OK' : 'error',
            'result' => $blocks,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $blocks = $this->blocks->getDeletedBlocksPaginated();
        $res = [
            'status' => $blocks ? 'OK' : 'error',
            'result' => $blocks,
        ];
        return response()->json($res);
    }
}
