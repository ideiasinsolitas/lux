<?php

namespace App\Services\Rest;

interface RestProcessorContract
{
    public function process($data, $code = 200, $errors = null);
}
