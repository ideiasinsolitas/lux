<?php

namespace App\Services\Rest;

class RestProcessor implements RestProcessorContract, HttpStatusCodesContract
{
    protected $httpMessages;

    protected $data;

    protected $code;

    public function __construct(RestMessage $message)
    {
        $this->body = $message;

        $this->httpMessages = [
            200 => self::MESSAGE_OK,
            201 => self::MESSAGE_CREATED,
            304 => self::MESSAGE_NOT_MODIFIED,
            400 => self::MESSAGE_BAD_REQUEST,
            403 => self::MESSAGE_FORBIDDEN,
            404 => self::MESSAGE_NOT_FOUND
        ];
    }

    protected function resolveRequest($request)
    {
        $json = $request->json()->all();

        if (is_array($json) && !empty($json)) {
            return $json;
        }
        
        return $request->all();
    }

    protected function send()
    {
        $data = $this->body->toArray();
        return ResponseFactory::make($data, $this->code);
    }

    public function process(array $data, $code = 200, $errors = null)
    {
        // not found exception
        if ($data === null && $code === null) {
            $this->code = 404;
        }
        // everything else works...
        if ($code !== null) {
            $this->code = $code;
        } else {
            $this->code = 200;
        }

        if ($data && !$errors) {
            if (is_scalar($data)) {
                $this->body->setData(array('test' => $data));
            } else {
                $this->body->setData($data);
            }
        }

        if (!$errors) {
            $this->body->setStatus('success');
            $message = $this->httpMessages[$this->code];
            $this->body->setMessage($message);
        }

        if ($errors && $this->code >= 400) {
            $this->body->setStatus('error');
            $this->body->setErrors($errors);
            $message = $this->httpMessages[$this->code];
            $this->body->setMessage($message);
        }

        return $this->send();
    }
}
