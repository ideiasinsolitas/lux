<?php

namespace App\Services\Intel\Location;

trait GmapsConverter
{
    protected $mapper;

    public function setMapper(LocationMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * /
     * @param  [type] $zip [description]
     * @return [type]      [description]
     */
    public function expandAdress($address)
    {
        $payload = array(
            'address' => urlencode($address),
            'sensor' => 'false',
            'key' => $this->apiKey
        );
        $response = $this->curl->get(self::ENDPOINT, $payload);
        return json_decode($response->body, true);
    }

    public function convert($address)
    {
        $this->mapper->mapToArray($this->expandAdress($address));
    }
}
