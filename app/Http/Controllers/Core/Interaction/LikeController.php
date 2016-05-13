<?php

namespace App\Http\Controllers\Core\Interaction\Like;

use App\Repositories\Core\Interaction\LikeDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class LikeController extends Controller
{
    /**
     * [$likes description]
     * @var [type]
     */
    protected $likes;

    /**
     * /
     * @param LikeDAO $likes [description]
     */
    public function __construct(LikeDAO $likes)
    {
        $this->likes = $likes;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $likes = $this->likes->getAll();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['user_id', 'likeable_type', 'likeable_id']);
        if (isset($input['pk'])) {
            $like = $this->likes->update($input, $input['pk']);
        } else {
            $like = $this->likes->create($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $like = $this->likes->getOne($id);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $like = $this->likes->delete($id);
    }
}
