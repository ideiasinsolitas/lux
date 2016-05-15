<?php

namespace App\Services\Rest;

class RestStatusMessage
{
    protected $statusCode;

    protected $data;

    protected $statusMessage;

    protected $errors;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setStatusMessage()
    {
        $this->statusMessage = $statusMessage;
    }

    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    public function addError($error, $message)
    {
        $this->errors[$error] = $message;
    }

    public function setErrors($errors)
    {
        foreach ($errors as $error => $message) {
            $this->addError($error, $message);
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function toArray()
    {
        return [
            'statusCode' => $this->statusCode,
            'statusMessage' => $this->statusMessage,
            'data' => $this->data,
            'errors' => $this->errors,
        ];
    }
}
