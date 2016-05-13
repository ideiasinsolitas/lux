<?php

namespace App\Http\Controllers\Core\Interaction\Folksonomy;

use App\Repositories\Core\Interaction\TermDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class TermController extends Controller
{
    /**
     * [$terms description]
     * @var [type]
     */
    protected $terms;

    /**
     * /
     * @param FolksonomyDAO $terms [description]
     */
    public function __construct(TermDAO $terms)
    {
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
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $id = $request->only(['id']);
        $input = $request->only(['term_id', 'user_id', 'usertaggable_type', 'usertaggable_id']);
        if (isset($id['id'])) {
            $folksonomy = $this->terms->create($input);
        } else {
            $folksonomy = $this->terms->update($input, $id['id']);
        }
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $folksonomy = $this->terms->delete($id);
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
        $terms = $this->terms->deleteMany($var['ids']);
    }

    /**
     * @param $id
     * @param RestoreFolksonomyRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->terms->restore($id);
    }
}
