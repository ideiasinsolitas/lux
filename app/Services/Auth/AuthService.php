<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\Guard;
use App\DAL\Core\Sys\Contracts\AuthDAOContract;

class AuthService implements Guard
{
    use AuthTrait;

    protected $user;
    protected $request;
    protected $model;

    public function __construct(UserAuthProvider $user)
    {
        $this->user = $user;
        $this->request = request();
    }

    protected function doAuthTokensMatch()
    {
        if ($this->request->cookie('authenticated_user_id') === $this->request->get('authenticated_user_id')) {
            $sessionToken = $this->request->session->get('auth_token');

            $cookieToken =  $this->request->cookie('auth_token');
            if ($sessionToken === $cookieToken) {
                return true;
            }
        }
        return false;
    }

    protected function doRememberTokensMatch()
    {
        if ($this->request->cookie('authenticated_user_id') === $this->request->get('authenticated_user_id')) {
            $remeberToken = $this->user->retriveById($this->request->get('authenticated_user_id'));

            $cookieToken =  $this->request->cookie('remember_token');
            if ($remeberToken === $cookieToken) {
                return true;
            }
        }
        return false;
    }

    protected function getUser($id)
    {
        if (!isset($this->model) || !$this->model instanceof UserAuthModel) {
            $this->model = $this->user->retrieveById($id);
        }
        return $this->model;
    }
}
