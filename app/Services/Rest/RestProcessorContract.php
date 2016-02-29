<?php

namespace App\Services\Rest;

interface RestProcessorContract
{
    public function process(array $data, $code = 200, $errors = null);

    public function sigle();

    public function listing();

    public function nullable();
}
