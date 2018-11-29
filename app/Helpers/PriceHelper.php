<?php

declare(strict_types = 1);

namespace App\Helpers;

/**
 * Class PriceHelper
 * @package App\Helpers
 */
class PriceHelper
{
    const EXCHANGES_RATES = [
        'USD' => 1.137485,
        'GBP' => 0.886137,
        'PLN' => 4.286670,
    ];

    /**
     * @param float $price
     * @param float $discount
     * @return float
     */
    public function discountedPrice(float $price, float $discount = 0): float
    {
        return (float)number_format(($price * (100 - $discount)) / 100, 2);
    }

    /**
     * @param float $price
     * @return int
     */
    public function convertToCents(float $price): int
    {
        return (int)($price * 100);
    }

    /**
     * @param float $price
     * @param string $currency
     * @return float
     */
    public function convertToCurrency(float $price, string $currency): float
    {
        return $price * array_get(self::EXCHANGES_RATES, $currency, 1000);
    }
}