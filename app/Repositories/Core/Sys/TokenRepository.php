<?php
namespace App\Repositories\Package\Token;

use App\Models\Package\Token\Token;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

class TokenRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Token';
    }


    public function generate($type)
    {
        if (!is_int($user_id) || !is_string($type)) {
            throw new \Exception("User_id must be integer and type must be string.", 001);
        }
        
        DB::table('core_tokens')
            ->delete()
            ->where('type', $type)
            ->where('user_id', $user_id);

        $id = DB::table('core_tokens')
            ->insertGetId([
                'user_id'=> $user_id,
                'token' => DB::raw('UUID()'),
                'type' => $type
            ]);
        
        if ($id) {
            throw new \Exception("Unable to insert token", 001);
        }

        return DB::table('core_tokens')
            ->select('token')
            ->where('id', $id)
            ->first();
    }

    public function validate($token, $type)
    {
        if (!is_string($token) || !is_string($type)) {
            throw new \Exception("Token and type must be strings", 002);
        }
        
        $sql = "SELECT token,user_id 
            FROM tokens 
            WHERE type=:type 
            AND token=:token";
        $record = $this->db->run($sql, array('type' => $type, 'token' => $token))->getFirstRecord();
        return $record->get('token');
        DB::table('core_tokens')
            ->select('token', 'user_id')
            ->where('type', $type)
            ->where('token', $token)
            ->first();
    }
}
