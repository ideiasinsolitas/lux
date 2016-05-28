<?php

namespace App\Services\Auth;

trait AuthTrait
{
    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return $this->doAuthTokensMatch();
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return ! $this->doAuthTokensMatch();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->getUser();
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        return $this->getUser()->getId();
    }
    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = array())
    {
        return false;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->model = $user;
    }
}
