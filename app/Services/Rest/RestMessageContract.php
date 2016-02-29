<?php

namespace App\Services\Rest;

interface RestMessageContract
{
    public function setStatus($status);

    public function getStatus();

    public function setMessage($message);

    public function getMessage();

    public function setError($error);

    public function getError();
}
