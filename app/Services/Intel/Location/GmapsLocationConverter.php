<?php

namespace App\Services;

use App\Services\Curl\Curl;

class GmapsLocationConverter implements LocationConverterContract, GmapsApiContract
{
    use GmapsConverter;

    protected $curl;

    protected $apiKey;

    /**
     * /
     */
    public function __construct($apiKey)
    {
        $this->curl = new Curl();
        $this->apiKey = $apiKey;
    }
}
