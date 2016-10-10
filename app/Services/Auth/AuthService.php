<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use App\DAL\Core\Sys\Contracts\AuthDAOContract;

class AuthService implements Guard
{
    use AuthTrait;

    protected $user;
    protected $request;
    protected $model;

    public function __construct(UserProvider $user)
    {
        $this->user = $user;
        $this->request = request();
    }

    protected function doAuthTokensMatch()
    {
        $has = session()->has('authenticated_user_id');
        $match = $this->request->cookie('authenticated_user_id') === session()->get('authenticated_user_id');
        if ($has && $match) {
            $sessionToken = session()->get('session_token');
            $cookieToken =  $this->request->cookie('session_token');
            if ($sessionToken === $cookieToken) {
                return true;
            }
        }
        return false;
    }

    protected function doRememberTokensMatch()
    {
        return true;
    }

    protected function getUser($id)
    {
        if (!isset($this->model) || !($this->model instanceof UserAuthEntity)) {
            $this->model = $this->user->retrieveById($id);
        }
        return $this->model;
    }

    protected function randomHash($string)
    {
        return md5(microtime(true) . $string);
    }

    public function authenticate($id, $remember = false)
    {
        $user = $this->getUser($id);
        $session_token = $this->randomHash($user->email);
        $this->request->session->set('authenticated_user_id', $user->id);
        $this->request->cookie('authenticated_user_id', $user->id);
        if ($remember) {
            $this->request->session->set('remember_token', $session_token);
            $this->request->cookie('remember_token', $session_token);
        }
        $this->request->session->set('session_token', $session_token);
        $this->request->cookie('session_token', $session_token);
    }

    public function isAuthenticated()
    {
        return $this->request->session->has('authenticated_user_id') &&
               $this->request->session->get('authenticated_user_id') > 0;
    }

    public function register($user)
    {
        return $this->user->create($user);
    }
}
