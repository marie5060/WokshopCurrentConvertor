<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ExchangeRate
{
    private string $exchangeRateApiUrl;

    public function __construct (private readonly string $exchangeRateApiKey,  private readonly HttpClientInterface $client)
    {

        $this-> exchangeRateApiUrl = "https://v6.exchangerate-api.com/v6/$exchangeRateApiKey/pair/EUR/USD" ;
       
    }

        public function convertEurToDollar(float $euroPrice )
    {
        $response = $this->client->request("GET", $this->exchangeRateApiUrl . "/$euroPrice");
        
        return $response->toArray()["conversion_result"];
    }

}