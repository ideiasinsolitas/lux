<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Contracts\AuthDAOContract;
use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;

class AuthDAO implements AuthDAOContract
{
    protected $user;
    protected $token;

    public function __construct(UserDAOContract $user, TokenDAOContract $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function getUserByPk($pk)
    {
        return $this->user->getOne($pk);
    }

    public function getUserByToken($pk, $token)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.' . self::PK, self::TABLE . '.email', self::TABLE . '.password')
            ->where(self::PK, $pk)
            ->where('token', $token)
            ->first();
    }

    public function getUserByCredentials($email, $password)
    {
        if (!is_string($email) && is_string($password)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.' . self::PK, self::TABLE . '.email', self::TABLE . '.password')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
    }
    
    public function registerUser(array $input)
    {
        return $this->user->insert($input);
    }

    public function createConfirmationToken($user_id)
    {
        return $this->token->generate($user_id, 'confirmation');
    }

    public function createForgotPasswordToken($user_id)
    {
        return $this->token->generate($user_id, 'confirmation');
    }

    public function resetPassword($user_id, $password)
    {
        return $this->user->update($user_id, ['password' => $password]);
    }

    public function checkCredentials($email, $hashedPassword)
    {
        if (!is_string($email) && !is_string($hashedPassword)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $user = $this->getCredentials($email);
        if ($user && $user->password === $hashedPassword) {
            return true;
        }
        return false;
    }

    public function regenerateRememberToken($user_id, $token)
    {
        $user = $this->getUserByToken($user_id, $token);
    }
}
