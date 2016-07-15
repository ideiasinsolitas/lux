<?php

namespace App\Services\Rest;

//use App\Services\Contracts\RestMessageContract;

class RestMessage //implements RestMessageContract
{
    protected $status;

    protected $data;

    protected $message;

    protected $errors;

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function addError($error)
    {
        $this->data['errors'][] = $error;
    }

    public function setErrors($errors)
    {
        $this->data['errors'] = $errors;
    }

    public function getErrors()
    {
        return $this->data['errors'];
    }
    
    public function toArray()
    {
        return array_filter([
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
        ], function ($v) {
            if ($v === null) {
                return false;
            }
            return true;
        });
    }
}
