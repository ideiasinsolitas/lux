<?php

namespace App\Http\Controllers\Core\Interaction\Folksonomy;

use App\Http\Controllers\Controller;

use App\DAL\Core\Interaction\Contracts\TermDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class TermController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$terms description]
     * @var [type]
     */
    protected $terms;

    /**
     * /
     * @param FolksonomyDAO $terms [description]
     */
    public function __construct(RestProcessor $rest, TermDAOContract $terms)
    {
        $this->rest = $rest;
        $this->terms = $terms;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $terms = $this->terms->getAll();
        return $this->rest->process($terms);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['term_id', 'user_id', 'usertaggable_type', 'usertaggable_id']);
        if ($request->has('pk')) {
            $term = $this->terms->update($input, (int) $request->get('pk'));
        } else {
            $input['node_id'] = $this->terms->createNode();
            $term = $this->terms->insert($input);
        }
        return $this->rest->process($term);
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $term = $this->terms->update(['activity' => 0], (int) $pk);
        return $this->rest->process($term);
    }
}
