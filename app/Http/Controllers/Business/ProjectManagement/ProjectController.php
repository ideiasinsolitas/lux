<?php

namespace App\Http\Controllers\Business\ProjectManagement\Project;

use App\Repositories\Business\ProjectManagementProjectRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ProjectController extends Controller
{
    /**
     * [$projects description]
     * @var [type]
     */
    protected $projects;

    /**
     * /
     * @param ProjectRepository $projects [description]
     */
    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.project_management.project');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $projects = $this->projects->getProjectsPaginated(config('business.project_management.project.default_per_page'))->items();
        $res = [
            'status' => $projects ? 'OK' : 'error',
            'result' => $projects,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        if (isset($input['id'])) {
            $project = $this->projects->create($input);
        } else {
            $project = $this->projects->update($input);
        }
        $res = [
            'status' => $project ? 'OK' : 'error',
            'message' => trans('alerts.project.stored'),
            'result' => $project,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projects->findOrFail($id, true);
        $res = [
            'status' => $project ? 'OK' : 'error',
            'result' => $project,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $project = $this->projects->delete($id);
        $res = [
            'status' => $project ? 'OK' : 'error',
            'message' => trans("alerts.projects.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
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
        $projects = $this->projects->deleteMany($var['ids']);
        $res = [
            'status' => $projects ? 'OK' : 'error',
            'message' => trans("alerts.projects.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteProjectRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->projects->delete($id);
        $res = [
            'status' => $project ? 'OK' : 'error',
            'message' => trans("alerts.projects.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreProjectRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->projects->restore($id);
        $res = [
            'status' => $project ? 'OK' : 'error',
            'message' => trans("alerts.projects.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkProjectRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->projects->mark($id, $status);
        $res = [
            'status' => $project ? 'OK' : 'error',
            'message' => trans("alerts.projects.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $projects = $this->projects->getProjectsPaginated(25, 0);
        $res = [
            'status' => $projects ? 'OK' : 'error',
            'result' => $projects,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $projects = $this->projects->getDeletedProjectsPaginated(25);
        $res = [
            'status' => $projects ? 'OK' : 'error',
            'result' => $projects,
        ];
        return response()->json($res);
    }
}
