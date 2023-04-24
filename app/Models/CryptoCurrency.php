<?php declare(strict_types=1);

namespace App\Models;

class CryptoCurrency
{
    private string $name;
    private int $id;
    private string $symbol;
    private float $price;
    private float $priceChange24h;
    private float $priceChange30d;
    private float $totalSupply;
    private ?float $maxSupply;
    private float $marketCap;

    public function __construct
    (
        string $name,
        int    $id,
        string $symbol,
        float  $price,
        float  $priceChange24h,
        float  $priceChange30d,
        float  $totalSupply,
        ?float $maxSupply,
        float  $marketCap
    )
    {
        $this->name = $name;
        $this->id = $id;
        $this->symbol = $symbol;
        $this->price = $price;
        $this->priceChange24h = $priceChange24h;
        $this->priceChange30d = $priceChange30d;
        $this->totalSupply = $totalSupply;
        $this->maxSupply = $maxSupply;
        $this->marketCap = $marketCap;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceChange24h(): float
    {
        return $this->priceChange24h;
    }

    public function getPriceChange30d(): float
    {
        return $this->priceChange30d;
    }

    public function getTotalSupply(): float
    {
        return $this->totalSupply;
    }

    public function getMaxSupply(): ?float
    {
        return $this->maxSupply;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }

    public function format(float $amount, int $decimals = 2): string
    {
        return number_format($amount, $decimals);
    }
}