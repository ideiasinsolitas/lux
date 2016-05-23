<?php

namespace App\Http\Controllers\Core\Sys\File;

use App\Repositories\Core\Sys\FileRepository;

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
     * @param FileRepository $files [description]
     */
    public function __construct(ResponseHandler $handler, FileRepository $files)
    {
        $handler->setPrefix('core.sys');
        $this->handler = $handler;
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
        $files = $this->files
            ->getFilesPaginated(config('core.sys.file.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($files);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $files = $this->files
            ->getDeactivatedFilesPaginated(config('core.sys.file.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $files = $this->files
            ->getDeletedFilesPaginated(config('core.sys.file.default_per_page'));
            
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
        $calendar = $this->files
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
        $calendar = $this->files
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
        $files = $this->files
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($files, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreFileRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->files
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkFileRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->files
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
