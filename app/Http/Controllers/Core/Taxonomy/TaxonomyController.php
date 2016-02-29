<?php

namespace App\Http\Controllers\Core\Taxonomy\Taxonomy;

use App\Repositories\Core\Taxonomy\TaxonomyDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class TaxonomyController extends Controller
{
    /**
     * [$taxonomys description]
     * @var [type]
     */
    protected $taxonomys;

    protected $handler;
    /**
     * /
     * @param TaxonomyDAO $taxonomys [description]
     */
    public function __construct(ResponseHandler $handler, TaxonomyDAO $taxonomys)
    {
        $handler->setPrefix('core.taxonomy');
        $this->handler = $handler;
        $this->taxonomys = $taxonomys;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['term_id', 'user_id', 'ownertaggable_type', 'ownertaggable_id']);
        $calendar = $request->has('id')
            ? $this->taxonomys
                ->update($input)
            : $this->taxonomys
                ->create($input);

        return $this->handler
            ->apiResponse($calendar, 'stored');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $taxonomys = $this->taxonomys
            ->getTaxonomysPaginated(config('core.taxonomy.taxonomy.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($taxonomys);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $taxonomys = $this->taxonomys
            ->getDeactivatedTaxonomysPaginated(config('core.taxonomy.taxonomy.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $taxonomys = $this->taxonomys
            ->getDeletedTaxonomysPaginated(config('core.taxonomy.taxonomy.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->taxonomys
            ->findOrFail($id, true);

        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $calendar = $this->taxonomys
            ->delete($id);

        return $this->handler
            ->apiResponse($calendar, 'deleted');
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
        $taxonomys = $this->taxonomys
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($taxonomys, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreTaxonomyRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->taxonomys
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkTaxonomyRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->taxonomys
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
