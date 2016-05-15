<?php
namespace App\DAL\Core\Sys;

use App\DAL\AbstractDAO;
use AppGeneralExceptions\GeneralException;
use App\DAL\Core\Sys\Contracts\TokenDAOContract;

class TokenDAO extends AbstractDAO implements TokenDAOContract
{

    public function __construct()
    {
    }

    protected function parseFilters(array $filters, $defaults = true)
    {
        throw new GeneralException("Not Implemented", 1);
    }

    public function getBuilder()
    {
        throw new GeneralException("Not Implemented", 1);
    }
 
    public function insert(array $input)
    {
        throw new GeneralException("Not Implemented", 1);
    }

    public function update(array $input, $pk)
    {
        throw new GeneralException("Not Implemented", 1);
    }

    public function generate($user_id, $type)
    {
        if (!is_int($user_id) || !is_string($type)) {
            throw new GeneralException("User_id must be integer and type must be string.", 001);
        }
        
        $id = DB::table('core_tokens')
            ->insertGetId([
                'user_id'=> $user_id,
                'token' => DB::raw('UUID()'),
                'type' => $type
            ]);
        
        if ($id) {
            throw new GeneralException("Unable to generate token", 001);
        }

        return DB::table('core_tokens')
            ->select('token')
            ->where('id', $id)
            ->first();
    }

    public function validate(array $token, $type)
    {
        if (!is_array($token) || !is_string($type)) {
            throw new GeneralException("Token and type must be strings", 002);
        }
        
        $result = DB::table('core_tokens')
            ->select('token', 'user_id')
            ->where('type', $type)
            ->where('token', $token['token'])
            ->first();

        if (!$result) {
            throw new GeneralException("Invalid token", 1);
        }

        DB::table('core_tokens')
            ->where('type', $type)
            ->where('token', $token['token'])
            ->delete();

        if ($result->user_id !== $token['user_id']) {
            throw new GeneralException("Invalid token", 1);
        }

        return $result;
    }
}
