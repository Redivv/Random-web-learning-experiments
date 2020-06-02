<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait mockApiRequest{
        private function createMockClientWithStatusCodeAndIfIsJson(int $responseCode, bool $isJson) : Client
        {
            $jsonData = '{"table":"A","currency":"euro","code":"EUR","rates":[{"no":"106/A/NBP/2020","effectiveDate":"2020-06-02","mid":4.3902}]}';
            $xmlData = 'AeuroEUR106/A/NBP/20202020-06-024.3902';
            
            $isJson ? $data = $jsonData : $data = $xmlData;
            
            $mock = new MockHandler([new Response($responseCode, ['X-Foo' => 'Bar'], $data),]);
            
            $handlerStack = HandlerStack::create($mock);
            return new Client([
                'base_uri' => 'http://api.nbp.pl',
                'handler' => $handlerStack,
            ]);
        }
    }