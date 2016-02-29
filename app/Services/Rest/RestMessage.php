<?php

namespace App\Services\Rest;

class RestMessage
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

    public function setMessage()
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function addError($error, $message)
    {
        $this->errors[$error] = $message;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
