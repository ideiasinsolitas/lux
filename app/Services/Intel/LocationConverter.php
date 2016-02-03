<?php

namespace App\Services;

use App\Services\Curl\Curl;

class LocationConverter
{
    protected $curl;
    protected $endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';
    protected $apiKey = 'AIzaSyDcIa5BwTx4FcqoKWQzFt7ZAjpThCoUE8E';

    /**
     * /
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * /
     * @param [type] $key [description]
     */
    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    /**
     * /
     * @param  [type] $zip [description]
     * @return [type]      [description]
     */
    public function completeAdress($address)
    {
        $payload = array(
            'address' => urlencode($address),
            'sensor' => 'false',
            'key' => $this->apiKey
        );
        $response = $this->curl->get($this->endpoint, $payload);
        return $response->body;
    }
}

// https://maps.googleapis.com/maps/api/geocode/json?address=22281-034,+Brasil&key=AIzaSyDcIa5BwTx4FcqoKWQzFt7ZAjpThCoUE8E
