<?php

namespace App\Http\Controllers\Core\Interaction\Comment;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Interaction\Contracts\CommentDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\Rest\RestProcessorContract;

class CommentController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$comments description]
     * @var [type]
     */
    protected $comments;

    /**
     * /
     * @param CommentDAO $comments [description]
     */
    public function __construct(RestProcessorContract $rest, CommentDAOContract $comments)
    {
        $this->rest = $rest;
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $comments = $this->comments->getAll(request()->get("filters"));
        return $comments;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['parent_id', 'user_id', 'commment']);
        if ($request->has('pk')) {
            $comment = $this->comments->update($input, (int) $request->get('pk'));
        } else {
            $comment = $this->comments->insert($input);
        }
        return $comment;
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $comment = $this->comments->getOne(['pk' => (int) $pk]);
        return $comment;
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $comment = $this->comments->delete((int) $pk);
        return $comment;
    }
}
