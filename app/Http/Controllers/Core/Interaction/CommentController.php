<?php

namespace App\Http\Controllers\Core\Interaction\Comment;

use App\Repositories\Core\Interaction\CommentDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class CommentController extends Controller
{
    /**
     * [$comments description]
     * @var [type]
     */
    protected $comments;

    /**
     * /
     * @param CommentDAO $comments [description]
     */
    public function __construct(CommentDAO $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $comments = $this->comments->getAll();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['parent_id', 'user_id', 'commment']);
        if (isset($input['id'])) {
            $comment = $this->comments->update($input, $input['id']);
        } else {
            $input['node_id'] = $this->comments->createNode('Comment');
            $comment = $this->comments->create($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $comment = $this->comments->getOne($id);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $comment = $this->comments->delete($id);
    }
}
