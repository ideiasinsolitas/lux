<?php

namespace App\Http\Controllers\Core\SiteBuilding;

use App\Repositories\Core\SiteBuilding\FileDAO;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

use Carbon\Carbon;

class FileController extends Controller
{
    /**
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
     * [$files description]
     * @var [type]
     */
    protected $files;

    /**
     * /
     * @param FileDAO $files [description]
     */
    public function __construct(RestProcessor $rest, FileDAO $files)
    {
        $this->rest = $rest;
        $this->files = $files;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
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

        if ($request->has('pk')) {
            $input['modified'] = Carbon::now();
            $this->files->update($input, (int) $request->get('pk'));
        } else {
            $input['node_id'] = $this->files->createNode();
            $input['created'] = Carbon::now();
            $this->files->insert($input);
        }
        return $this->rest->process($file);
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $files = $this->files->getAll();
        return $this->rest->process($files);
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $file = $this->files->getOne(['pk' => (int) $pk]);
        return $this->rest->process($file);
    }

    /**
     * /
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $file = $this->files->update(['activity' => 0, 'deleted' => Carbon::now()], (int) $pk);
        return $this->rest->process($file);
    }
}
