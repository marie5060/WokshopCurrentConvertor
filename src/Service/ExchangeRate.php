<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;


class ExchangeRate
{
    private string $exchangeRateApiUrl;

    public function __construct (private readonly string $exchangeRateApiKey,  private readonly HttpClientInterface $client)
    {

        $this-> exchangeRateApiUrl = "https://v6.exchangerate-api.com/v6/$exchangeRateApiKey/pair/" ;
       
    }

        public function convertEurToDollar(float $euroPrice )
    {
        return $this->currentCurrency($euroPrice,'EUR', 'USD');
    }

    public function convertEurToYen(float $euroPrice ) :float
    {
       return $this->currentCurrency($euroPrice,'EUR', 'JPY');
    }

    private function currentCurrency( float $amount, string $entryCurrency, string $outCurrency) : float 
    {
        $response = $this->client ->request(Request::METHOD_GET, $this->exchangeRateApiUrl . "$entryCurrency/$outCurrency/$amount");
        return $response->toArray()["conversion_result"];
    }
}