<?php

namespace App\DAL\Core\Sys\Contracts;

interface AuthDAOContract
{
    const TABLE = 'core_users';

    const RESET_TABLE = 'core_password_resets';
    
    const PK = 'id';

    const PASSWORD = 'password';

    const EMAIL = 'email';

    const USERNAME = 'username';

    public function getUserByPk($pk);

    public function getUserByToken($pk, $token);

    public function getUserByCredentials($email, $password);

    public function registerUser(array $input);

    public function createConfirmationToken($user_id);

    public function createForgotPasswordToken($user_id);

    public function resetPassword($user_id, $password);

    public function checkCredentials($email, $hashedPassword);

    public function regenerateRememberToken($user_id, $token);
}
