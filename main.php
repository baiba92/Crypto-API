<?php declare(strict_types=1);

use App\ApiClient;
use App\CryptoCurrency;

require_once 'vendor/autoload.php';

$apiClient = new ApiClient();

$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotEnv->load();

$count = (int)readline('Enter number of crypto currencies you would like to list: ');

$currencies = $apiClient->getCurrencies($count);

echo PHP_EOL;
/** @var CryptoCurrency $currency */
foreach ($currencies as $key => $currency) {
    $key = $key + 1;
    echo "[$key]" . PHP_EOL;
    echo "Name: {$currency->getName()}" . PHP_EOL;
    echo "ID: {$currency->getId()}" . PHP_EOL;
    echo "Symbol: {$currency->getSymbol()}" . PHP_EOL;
    echo "Price: \${$currency->format($currency->getPrice())}" . PHP_EOL;
    echo "Price change (24h): {$currency->format($currency->getPriceChange24h())}%" . PHP_EOL;
    echo "Price change (30d): {$currency->format($currency->getPriceChange30d())}%" . PHP_EOL;
    echo "Total supply: {$currency->format($currency->getTotalSupply())}" . PHP_EOL;
    $maxSupply = $currency->getMaxSupply() ? $currency->format($currency->getMaxSupply()) : 'unlimited';
    echo "Maximum supply: $maxSupply" . PHP_EOL;
    echo "Market cap: \${$currency->format($currency->getMarketCap() / 1000000000)}B" . PHP_EOL;
    echo PHP_EOL;
}