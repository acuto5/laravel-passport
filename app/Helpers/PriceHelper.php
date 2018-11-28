<?php

declare(strict_types = 1);

namespace App\Helpers;

/**
 * Class PriceHelper
 * @package App\Helpers
 */
class PriceHelper
{
    /**
     * @param float $price
     * @param float $discount
     * @return float
     */
    public function discountedPrice(float $price, float $discount = 0): float
    {
        return (float)number_format(($price * (100 - $discount)) / 100, 2);
    }
}