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
        $blocks = $this->blocks->getAll();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function save(StoreRequest $request)
    {
        $input = $request->only(['id', 'area_id', 'name']);
        if (isset($input['id'])) {
            $block = $this->blocks->create($input);
        } else {
            $block = $this->blocks->update($input, $input['id']);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $block = $this->blocks->getOne($id);
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
    }
}
