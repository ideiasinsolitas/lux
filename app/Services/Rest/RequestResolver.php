<?php

namespace App\Services\Rest;

class RequestResolver
{
    public static function resolve($request)
    {
        $json = $request->json();

        if (!empty($json->all())) {
            $request->request = $json;
        }
        return $request;
    }
}
