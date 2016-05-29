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

    public function __construct(RestProcessorContract $rest, AuthServiceContract $auth)
    {
        $this->rest = $rest;
        $this->auth = $auth;
    }

    public function form()
    {
        if ($this->auth->guest()) {
            return view('auth.form');
        }
        throw new \Exception("You cannot do that.", 1);
        
    }

    public function login(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['email', 'password']);
            $result = $this->auth->func();
            return $this->rest->process($result);
        }
        throw new \Exception("You cannot do that.", 1);
    }

    public function register(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation']);
            $result = $this->auth->func();
            return $this->rest->process($result);
        }
        throw new \Exception("You cannot do that.", 1);
    }

    public function forgotPassword(GenericRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['email']);
            $result = $this->auth->func();
            return $this->rest->process($result);
        }
        throw new \Exception("You cannot do that.", 1);
    }

    public function forgotPasswordForm()
    {
        if ($this->auth->guest()) {
            return view('auth.password');
        }
        throw new \Exception("You cannot do that.", 1);
    }

    public function resetForm()
    {
        if ($this->auth->guest()) {
            return view('auth.reset');
        }
        throw new \Exception("You cannot do that.", 1);
    }

    public function resetPassword(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['token']);
            $result = $this->auth->func();
            return $this->rest->process($result);
        }
        throw new \Exception("You cannot do that.", 1);
    }
}
