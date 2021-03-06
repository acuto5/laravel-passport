<?php

declare(strict_types = 1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PriceConvert
 * @method static float discountedPrice(float $price, float $discount = 0)
 * @method static int convertToCents(float $price)
 * @method static float convertToCurrency(float $price, string $currency)
 * @package App\Facades
 */
class PriceConvert extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'price.convert';
    }
}