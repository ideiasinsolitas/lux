<?php

namespace App\Http\Controllers\Core\Sys\File;

use App\Repositories\Core\Sys\FileDAO;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class FileController extends Controller
{
    /**
     * [$files description]
     * @var [type]
     */
    protected $files;

    protected $handler;
    /**
     * /
     * @param FileDAO $files [description]
     */
    public function __construct(FileDAO $files)
    {
        $this->files = $files;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function save(StoreRequest $request)
    {
        $input = $request->only([
            'id',
            'node_id',
            'type_id',
            'name',
            'description',
            'filepath',
            'filename',
            'mimetype',
            'extension',
            'width',
            'height',
            'activity'
        ]);
        $calendar = $request->has('id')
            ? $this->files
                ->update($input)
            : $this->files
                ->create($input);
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $files = $this->files->getAll();
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->files->getOne($id);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $calendar = $this->files->delete($id);
    }
}
