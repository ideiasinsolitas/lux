<?php

namespace App\Http\Controllers\Core\SiteBuilding;

use Illuminate\Routing\Controller;

use App\DAL\Core\SiteBuilding\BlockDAO;
use App\Services\Rest\RestProcessorContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class BlockController extends Controller
{
    protected $rest;

    /**
     * [$blocks description]
     * @var [type]
     */
    protected $blocks;

    /**
     * /
     * @param BlockDAO $blocks [description]
     */
    public function __construct(RestProcessorContract $rest, BlockDAO $blocks)
    {
        $this->rest = $rest;
        $this->blocks = $blocks;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $blocks = $this->blocks->getAll(request()->get("filters"));
        return $blocks;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'area_id', 'name']);
        if ($request->has('id')) {
            $block = $this->blocks->create($input);
        } else {
            $block = $this->blocks->update($input, (int) $request->get('pk'));
        }
        return $block;
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $block = $this->blocks->getOne($id);
        return $block;
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
        return $block;
    }
}
