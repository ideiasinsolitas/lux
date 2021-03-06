<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller;

use App\DAL\Core\Sys\Contracts\AuthDAOContract;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;
use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\Http\Requests\Generic\GenericRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Services\Rest\RestProcessorContract;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
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

    public function logout()
    {
        if (!$this->auth->guest()) {
            $this->auth->logout();
        }
        return redirect('/login');
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
            $input = $request->only(['password']);
            $result = $this->auth->reset($input);
            return redirect('/');
        }
        return redirect('/dashboard');
    }
}
