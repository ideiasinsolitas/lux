<?php

namespace App\Http\Controllers;

use App\DAL\Core\Sys\Contracts\AuthDAOContract;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;
use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\GenericRequest;
use App\Http\Requests\Generic\StoreRequest;

class AuthController extends Controller
{
    protected $rest;
    protected $auth;

    public function __construct(RestProcessor $rest, AuthService $auth)
    {
        $this->rest = $rest;
        $this->auth = $auth;
    }

    public function form()
    {
        return view('auth.form');
    }

    public function login(StoreRequest $request)
    {
        $input = $request->only(['email', 'password']);
        
        return $this->rest->process();
    }

    public function register(StoreRequest $request)
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation']);
        return $this->rest->process();
    }

    public function forgotPassword(GenericRequest $request)
    {
        $input = $request->only(['email']);
        return $this->rest->process();
    }

    public function forgotPasswordForm()
    {
        return view('auth.password');
    }

    public function resetForm()
    {
        return view('auth.reset');
    }

    public function resetPassword(StoreRequest $request)
    {
        $input = $request->only(['token']);
    }
}
