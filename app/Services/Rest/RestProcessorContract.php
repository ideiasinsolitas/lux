<?php

namespace App\Services\Rest;

interface RestProcessorContract
{
    public function process(array $data, $code = 200, $errors = null);
}
