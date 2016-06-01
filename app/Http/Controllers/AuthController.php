<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;

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

    public function __construct(RestProcessorContract $rest, Guard $auth)
    {
        $this->rest = $rest;
        $this->auth = $auth;
    }

    public function form()
    {
        if ($this->auth->guest()) {
            return view('auth.form');
        }
        return redirect('/dashboard');
        
    }

    public function login(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['email', 'password']);
            $result = $this->auth->validate($input);
            if (!$result) {
                return redirect('/login');
            }
        }
        return redirect('/dashboard');
    }

    public function register(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation']);
            $result = $this->auth->func();
            return redirect('/login');
        }
        return redirect('/dashboard');
    }

    public function forgotPassword(GenericRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['email']);
            $result = $this->auth->register($input);
            return redirect('/');
        }
        return redirect('/dashboard');
    }

    public function forgotPasswordForm()
    {
        if ($this->auth->guest()) {
            return view('auth.password');
        }
        return redirect('/dashboard');
    }

    public function resetForm()
    {
        if ($this->auth->guest()) {
            return view('auth.reset');
        }
        return redirect('/dashboard');
    }

    public function resetPassword(StoreRequest $request)
    {
        if ($this->auth->guest()) {
            $input = $request->only(['token']);
            $result = $this->auth->reset($input);
            return redirect('/');
        }
        return redirect('/dashboard');
    }
}
