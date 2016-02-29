<?php

namespace App\Http\Controllers\Core\Term;

use App\Repositories\Core\Term\TermDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class TermController extends Controller
{
    /**
     * [$terms description]
     * @var [type]
     */
    protected $terms;

    protected $handler;
    /**
     * /
     * @param TermDAO $terms [description]
     */
    public function __construct(ResponseHandler $handler, TermDAO $terms)
    {
        $handler->setPrefix('core.taxonomy');
        $this->handler = $handler;
        $this->terms = $terms;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'node_id', 'parent_id', 'type_id', 'activity']);
        $calendar = $request->has('id')
            ? $this->terms
                ->update($input)
            : $this->terms
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
        $terms = $this->terms
            ->getTermsPaginated(config('core.taxonomy.term.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($terms);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $terms = $this->terms
            ->getDeactivatedTermsPaginated(config('core.taxonomy.term.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $terms = $this->terms
            ->getDeletedTermsPaginated(config('core.taxonomy.term.default_per_page'));
            
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
        $calendar = $this->terms
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
        $calendar = $this->terms
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
        $terms = $this->terms
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($terms, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreTermRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->terms
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkTermRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->terms
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
