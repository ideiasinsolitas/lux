<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\Exceptions\GeneralException;

class AuthDAO implements AuthDAOContract
{
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

    public function getCredentials($email)
    {
        if (!is_string($email)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->select(self::TABLE . '.' . self::PK, self::TABLE . '.email', self::TABLE . '.password')
            ->where('email', $email)
            ->first();
    }
}
