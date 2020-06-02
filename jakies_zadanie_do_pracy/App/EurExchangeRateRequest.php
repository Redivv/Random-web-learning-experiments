<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class EurExchangeRateRequest
{
    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchJson() : Response
    {
        $response = $this->httpClient->request('GET', '/api/exchangerates/rates/A/EUR', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $response;
    }

    public function fetchXml() : Response
    {
        $response = $this->httpClient->request('GET', '/api/exchangerates/rates/A/EUR', [
            'headers' => [
                'Accept' => 'application/xml',
            ],
        ]);

        return $response;
    }
}
