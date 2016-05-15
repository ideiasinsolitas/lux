<?php

namespace App\Services\Rest;

class RestProcessor implements HttpStatusCodesContracts
{
    protected $httpMessages;

    protected $data;

    public function __construct(RestMessageContract $message)
    {
        $this->message = $message;

        $this->httpStatuses = [
            200 => self::HTTP_OK,
        ];
    }

    protected function getHttpStatus($code = null)
    {
        if (!$code) {
            $code = $this->code;
        }
        return $this->httpStatuses[$code];
    }

    public function process(array $data, $code = 200, $errors = null)
    {
        if (!$data && !$errors) {
            $this->message->setStatusMessage($this->getHttpStatus($code));
            $this->message->setData(false);
        }

        if (empty($data)) {
            $this->code = 404;
            $this->message->setStatusMessage($this->getHttpStatus());
            $this->message->setData(false);
        }

        if ($errors) {
            $this->code = 400;
            $this->message->setMessage($this->getHttpStatus());
            $this->message->setErrors($errors);
        }

        $this->message->setData($data);

        return response()->json($this->message->toArray());
    }
}
