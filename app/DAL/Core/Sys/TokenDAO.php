<?php
namespace App\DAL\Core\Sys;

use App\DAL\AbstractDAO;
use AppGeneralExceptions\GeneralException;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;

class TokenDAO implements TokenDAOContract
{
    public function generate($user_id, $type)
    {
        if (!is_int($user_id) || !is_string($type)) {
            throw new GeneralException("User_id must be integer and type must be string.", 001);
        }
        
        $id = DB::table(self::TABLE)
            ->insertGetId([
                'user_id'=> $user_id,
                'token' => DB::raw('UUID()'),
                'type' => $type
            ]);

        if (!$id) {
            throw new GeneralException("Unable to generate token", 001);
        }

        return DB::table(self::TABLE)
            ->select('token')
            ->where('id', $id)
            ->first();
    }

    public function regenerate($user_id, $type)
    {
        $result = DB::table(self::TABLE)
            ->where('type', $type)
            ->where('user_id', $user_id)
            ->delete();

        if (!$result) {
            throw new GeneralException("Token does not exist.", 1);
        }

        return $this->generate($user_id, $type);
    }

    public function validate(array $token, $type)
    {
        if (!is_array($token) || !is_string($type)) {
            throw new GeneralException("Token and type must be strings", 002);
        }
        
        $result = DB::table(self::TABLE)
            ->select('token', 'user_id')
            ->where('type', $type)
            ->where('token', $token['token'])
            ->first();

        if (!$result) {
            throw new GeneralException("Invalid token", 1);
        }

        if ($result->user_id !== $token['user_id']) {
            throw new GeneralException("Invalid token", 1);
        }

        $delete = DB::table(self::TABLE)
            ->where('type', $type)
            ->where('token', $token['token'])
            ->delete();

        if (!$delete) {
            throw new GeneralException("Could not delete token", 1);
        }

        return $result;
    }
}
