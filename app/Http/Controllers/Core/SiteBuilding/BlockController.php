<?php

namespace App\Http\Controllers\Core\SiteBuilding\Block;

use Illuminate\Routing\Controller;

use App\DAL\Core\SiteBuilding\BlockRepository;
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
     * @param BlockRepository $blocks [description]
     */
    public function __construct(RestProcessorContract $rest, BlockRepository $blocks)
    {
        $this->rest = $rest;
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
        return $this->rest->process($blocks);
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
        return $this->rest->process($block);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $block = $this->blocks->getOne($id);
        return $this->rest->process($block);
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
        return $this->rest->process($block);
    }
}
