<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;

class AuthDAO extends AbstractDAO implements AuthDAOContract
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

    public function getCredentials($email)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.' . self::PK, self::TABLE . '.email', self::TABLE . '.password')
            ->where('email', $email)
            ->first();
    }
}
