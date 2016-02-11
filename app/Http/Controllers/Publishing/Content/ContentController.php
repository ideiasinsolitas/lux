<?php

namespace App\Http\Controllers\Publishing\ContentManagement;

use App\Repositories\Publishing\ContentManagement\ContentRepository;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class ContentController extends Controller
{
    /**
     * [$contents description]
     * @var [type]
     */
    protected $contents;

    protected $handler;
    /**
     * /
     * @param ContentRepository $contents [description]
     */
    public function __construct(ResponseHandler $handler, ContentRepository $contents)
    {
        $handler->setPrefix('publishing.content_management');
        $this->handler = $handler;
        $this->contents = $contents;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $calendar = $request->has('id')
            ? $this->contents
                ->update($input)
            : $this->contents
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
        $contents = $this->contents
            ->getContentsPaginated(config('publishing.content_management.content.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($contents);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $contents = $this->contents
            ->getDeactivatedContentsPaginated(config('publishing.content_management.content.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $contents = $this->contents
            ->getDeletedContentsPaginated(config('publishing.content_management.content.default_per_page'));
            
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
        $calendar = $this->contents
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
        $calendar = $this->contents
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
        $contents = $this->contents
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($contents, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreContentRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->contents
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkContentRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->contents
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
