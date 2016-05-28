<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

class UserAuthModel implements Authenticatable
{
    protected $id;
    protected $token;
    protected $password;

    public static function createFromUser($user)
    {
        return new self($user->id, $user->token, $user->password);
    }

    public function __construct($id = null, $token = null, $password = null)
    {
        $this->id = $id;
        $this->token = $token;
        $this->password = $password;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setToken($value)
    {
        $this->token = $value;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function setRoles(Collection $value)
    {
        $this->roles = $value;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token_id';
    }
}
