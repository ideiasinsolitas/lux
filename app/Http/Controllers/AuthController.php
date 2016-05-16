<?php

namespace App\Http\Controllers;

use App\DAL\Core\Sys\AuthDAO;
use App\DAL\Core\Sys\TokenDAO;
use App\DAL\Core\Sys\UserDAO;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;

class AuthController extends Controller
{
    protected $rest;
    protected $auth;
    protected $token;
    protected $user;

    public function __construct(RestProcessor $rest, AuthDAO $auth, TokenDAO $token, UserDAO $user)
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
