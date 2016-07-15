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

    protected function send()
    {
        $data = $this->body->toArray();
        return ResponseFactory::make($data, $this->code);
    }

    public function process($data, $code = 200, $errors = null)
    {
        // not found exception
        if (empty($data)) {
            $this->code = 404;
        }

        // everything else works...
        if ($code) {
            $this->code = $code;
        } else {
            $this->code = 200;
        }

        if ($data && !$errors) {
            $body = $data;
            if ($data instanceof \Illuminate\Http\Response) {
                $body = $data->original;
            }
            $this->body->setData($body);
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
