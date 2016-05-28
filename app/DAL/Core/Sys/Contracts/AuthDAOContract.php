<?php

namespace App\DAL\Core\Sys\Contracts;

interface AuthDAOContract
{
    const TABLE = 'core_users';
    const PK = 'id';

    public function getUserByPk($pk);

    public function getUserByToken($pk, $token);

    public function registerUser(array $input);

    public function createConfirmationToken($user_id);

    public function createForgotPasswordToken($user_id);

    public function resetPassword($user_id, $password);

    public function checkCredentials($email, $hashedPassword);

    public function getByCredentials($email, $password);

    public function regenerateRememberToken($user_id, $token);
}
