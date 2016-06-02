<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\Rest\RestProcessorContract;

class UserController extends Controller
{
    protected $rest;
    protected $users;

    public function __construct(RestProcessorContract $rest, UserDAOContract $users)
    {
        $this->rest = $rest;
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->getAll();
        return $this->rest->process($users);
    }

    public function store()
    {
        $input = $request->only(['username', 'email', 'first_name', 'middle_name', 'last_name', 'display_name', 'activity']);
        if ($request->has('pk')) {
            $input['modified'] = Carbon::now();
            $user = $this->users->update($input, (int) $request->get('pk'));
        } else {
            $input['created'] = Carbon::now();
            $user = $this->users->insert($input);
        }
        return $this->rest->process($user);
    }

    public function show($pk)
    {
        $comment = $this->comments->getOne(['pk' => (int) $pk]);
        return $this->rest->process($comment);
    }

    public function delete($pk)
    {
        $user = $this->users->update(['activity' => 0, 'deleted' => Carbon::now()], (int) $pk);
        return $this->rest->process($user);
    }
}
