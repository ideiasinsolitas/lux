<?php

namespace App\Services\Rest;

class ResponseFactory
{
    public static function make(array $data = array(), $code = 200)
    {
        return new RestResponse($data, $code);
    }
}
