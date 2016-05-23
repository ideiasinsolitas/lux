<?php

namespace App\DAL\Core\Sys\Contracts;

interface TokenDAOContract
{
    const TABLE = "core_tokens";
    
    const PK = "id";

    public function generate($type);

    public function validate(array $token, $type);
}
