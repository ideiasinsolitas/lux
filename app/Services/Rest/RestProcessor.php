<?php
<<<<<<< HEAD

namespace App\Services\Rest;

class RestProcessor implements HttpStatusCodesContracts
=======
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\Services\Rest;

class RestProcessor implements RestProcessorContract, HttpStatusCodesContract
>>>>>>> core-develop
{
    protected $httpMessages;

    protected $data;

<<<<<<< HEAD
    protected $currentStep = 0;

    public function __construct(RestMessageContract $message)
=======
    protected $code;

    public function __construct(Message $message)
>>>>>>> core-develop
    {
        $this->body = $message;

        $this->httpMessages = [
<<<<<<< HEAD
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
=======
            200 => self::MESSAGE_OK,
            201 => self::MESSAGE_CREATED,
            304 => self::MESSAGE_NOT_MODIFIED,
            400 => self::MESSAGE_BAD_REQUEST,
            403 => self::MESSAGE_FORBIDDEN,
            404 => self::MESSAGE_NOT_FOUND
        ];
    }

    public function resolveRequest($request)
    {
        $json = $request->json()->all();

        if (is_array($json) && !empty($json)) {
            return $json;
        }
        
        return $request->all();
    }

    public function process($data = null, $code = null, $errors = null)
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

    public function send()
    {
        $data = $this->body->toArray();
        return ResponseFactory::make(array_filter($data), $this->code);
>>>>>>> core-develop
    }
}
