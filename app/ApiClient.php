<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    public function getCurrencies(int $currencyCount): array
    {
        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?limit=$currencyCount";
        $response = $this->client->get($url, [
            'headers' => [
                'Accept' => 'application/json',
                'X-CMC_PRO_API_KEY' => 'f67c1856-c27c-4c2f-87ac-c94a2a2df026'
            ]
        ]);
        $records = (json_decode($response->getBody()->getContents()))->data;

        $currencies = [];
        foreach ($records as $record) {
            $currencies[] = new CryptoCurrency(
                $record->name,
                $record->symbol,
                $record->quote->USD->price,
                $record->quote->USD->percent_change_24h,
                $record->quote->USD->percent_change_30d,
                $record->total_supply,
                $record->max_supply,
                $record->quote->USD->market_cap
            );
        }
        return $currencies;
    }
}