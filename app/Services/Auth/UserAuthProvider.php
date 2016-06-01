<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\UserProvider;

class UserAuthProvider implements UserProvider
{
    protected $auth;

    public function __construct(AuthDAOContract $auth)
    {
        $this->auth = $auth;
    }

    public function create(array $user)
    {
        return $this->auth->registerUser($user);
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return UserAuthModel::createFromUser($this->auth->getUserByPk($identifier));
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed   $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return UserAuthModel::createFromUser($this->auth->getUserByToken($identifier, $token));
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $this->auth->regenerateRememberToken($user->getId(), $token);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = $this->auth->getByCredentials($credentials['email'], $credentials['password']);
        return UserAuthModel::createFromUser($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->getEmail() === $credentials['email'] &&
               $user->getPassword() === $credentials['password'];
    }
}
