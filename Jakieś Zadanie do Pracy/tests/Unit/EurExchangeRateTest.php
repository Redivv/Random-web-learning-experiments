<?php

use App\EurExchangeRateRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tests\mockApiRequest;

class EurExchangeRateRequestTest extends TestCase
{
    use mockApiRequest;
    /** @test */
    public function canSuccessfullyFetchRateFromRealAPI()
    {
        $exchangeRate = $this->fetchJsonRateFromApi(new Client(['base_uri' => 'http://api.nbp.pl']));

        $this->assertEquals(200, $exchangeRate->getStatusCode());
    }

    /** @test */
    public function willReceiveAnExceptionWhenAPIIsDown()
    {
        $mockClient = $this->createMockClientWithStatusCodeAndIfIsJson(404,true);

        $this->expectException(Exception::class);
        $this->fetchJsonRateFromApi($mockClient);

    }

    /** @test */
    public function responseReturnsJSONData()
    {
        $mockClient = $this->createMockClientWithStatusCodeAndIfIsJson(200,true);
        $exchangeRate = $this->fetchJsonRateFromApi($mockClient);

        $this->assertJson($exchangeRate->getBody()->getContents());
    }

    /** @test */
    public function responseReturnsXMLData()
    {
        $mockClient = $this->createMockClientWithStatusCodeAndIfIsJson(200,false);
        $exchangeRate = $this->fetchXmlRateFromApi($mockClient);

        $this->assertEquals('AeuroEUR106/A/NBP/20202020-06-024.3902',$exchangeRate->getBody()->getContents());
    }
    
    

    private function fetchJsonRateFromApi(Client $requestClient) : Response
    {
        $exchangeRateRequest = new EurExchangeRateRequest($requestClient);

        $exchangeRate = $exchangeRateRequest->fetchJson();

        return $exchangeRate;
    }

    private function fetchXmlRateFromApi(Client $requestClient) : Response
    {
        $exchangeRateRequest = new EurExchangeRateRequest($requestClient);

        $exchangeRate = $exchangeRateRequest->fetchXml();

        return $exchangeRate;
    }
    
    
    
}