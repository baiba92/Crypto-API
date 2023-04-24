<?php declare(strict_types=1);

namespace App;

use App\Models\CryptoCurrency;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    public function fetchCurrencies(int $currencyCount): array
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $response = $this->client->get($url, [
            'headers' => [
                'Accept' => 'application/json',
                'X-CMC_PRO_API_KEY' => $_ENV['API_KEY']
            ],
            'query' => [
                'limit' => $currencyCount
            ]
        ]);
        return (json_decode($response->getBody()->getContents()))->data;
    }

    public function createCollection(array $currencyRecords): array
    {
        $currencies = [];
        foreach ($currencyRecords as $record) {
            $currencies[] = new CryptoCurrency(
                $record->name,
                $record->id,
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