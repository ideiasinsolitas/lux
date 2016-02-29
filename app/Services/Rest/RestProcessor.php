<?php

namespace App\Services\Rest;

class RestProcessor implements HttpStatusCodesContracts
{
    protected $httpMessages;

    protected $data;

    protected $currentStep = 0;

    public function __construct(RestMessageContract $message)
    {
        $this->body = $message;

        $this->httpMessages = [
            200 => self::HTTP_OK,
        ];
    }

    protected function stepFoward()
    {
        $this->currentStep++;
    }

    protected function hasData()
    {
        return !empty($request->all());
    }

    protected function makeResponse()
    {
        return new JsonResponse($this->code, $this->body->toArray());
    }

    public function process(array $data, $code = 200, $errors = null)
    {
        if (!$data && !$error) {
            $this->body->setMessage($this->getHttpMessage($code));
            $this->body->setData(false);
        }

        if ($error) {
            $this->code = 500;
            $this->body->setErrors($errors);
        }

        $this->body->setData($data);
    }

    public function listing()
    {
        return $this;
    }

    public function single()
    {
        return $this;
    }

    public function nullable()
    {
        return $this;
    }
}
