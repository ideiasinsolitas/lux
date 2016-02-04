<?php

namespace App\Services;

class Format
{
    public static function response($model, $message = '', $next = null, $event = null, $payload = null)
    {
        $response = [];
        $response['spa'] = [];
        $model ? $response['result'] = $model : null;
        $model && !empty($message) ? $response['message'] = $message : null;
        $model ? $response['status'] = 'OK' : $response['status'] = 'error';
        $next && !empty($next) ? $response['spa']['next'] = $next : null;
        $event && !empty($event) ? $response['spa']['event'] = $event : null;
        $payload && !empty($payload) ? $response['spa']['payload'] = $payload : null;
        return $response;
    }
}
