<?php

namespace App\Http\Controllers;

use App\DAL\Core\Sys\Contracts\AuthDAOContract;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;
use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;

class AuthController extends Controller
{
    protected $rest;
    protected $auth;
    protected $token;
    protected $user;

    public function __construct(RestProcessor $rest, AuthDAOContract $auth, TokenDAOContract $token, UserDAOContract $user)
    {
        $this->rest = $rest;
        $this->auth = $auth;
        $this->token = $token;
        $this->user = $user;
    }

    public function form()
    {
        return view('auth.form');
    }

    public function login(StoreRequest $request)
    {
        $input = $request->only(['email', 'password']);
    }

    public function register(StoreRequest $request)
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation']);
    }

    public function forgotPassword()
    {
        return view('auth.reset');
    }

    public function resetForm()
    {
    }

    public function resetPassword(StoreRequest $request)
    {
        $input = $request->only(['token']);
    }
}
