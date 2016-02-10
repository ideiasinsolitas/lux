<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseHandler
{
    protected $prefix;

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    protected function getMessage($action)
    {
        return !empty($action) ? trans('alerts.' . $this->prefix . '.' . $action) : null;
    }

    public function apiResponse($model = null, $action = '', $payload = null)
    {
        $data = [];
        $message = $this->getMessage($action);
        $model ? $data['result'] = $model : null;
        $model && !empty($message) ? $data['message'] = $message : null;
        $model ? $data['status'] = 'OK' : $data['status'] = 'error';
        $payload && !empty($payload) ? $data['payload'] = $payload : null;

        $response = new JsonResponse($data);
        return $response;
    }
}
