<?php

namespace App\Services;

readonly class PriceService
{
    public function __construct(
        private float $price,
    )
    {
    }

    public function formatPrice($decimals = 2, $decimalSeparator = '.', $thousandsSeparator = ' ')
    {
        $number = preg_replace('/[^0-9\-\.]/', '', $this->price);
        $number = floatval($number);

        return number_format($number, $decimals, $decimalSeparator, $thousandsSeparator);
    }
}
