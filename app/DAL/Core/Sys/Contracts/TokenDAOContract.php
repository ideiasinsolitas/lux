<?php

namespace App\DAL\Core\Sys\Contracts;

interface TokenDAOContract
{
    const TABLE = "core_tokens";
    
    const PK = "id";

    const FK = "token_id";

    public function generate($user_id, $type);

    public function regenerate($user_id, $type);

    public function validate(array $token, $type);
}
