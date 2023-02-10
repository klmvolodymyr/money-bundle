<?php

namespace VolodymyrKlymniuk\MoneyBundle\Parser;

use VolodymyrKlymniuk\MoneyBundle\Money\CurrencyInterface;

interface ParserInterface
{
    /**
     * Examples of input arguments:
     *  - $amount=100.10 and $delimiter='.' for USD returns 10010
     *  - $amount=1,12 and $delimiter=',' for ETH returns 1120000000000000000
     *  - $amount=1.42 and $delimiter='.' for BTC returns 142000000
     *
     * @param string            $amount    Amount with fractional part separated by provider delimiter.
     * @param CurrencyInterface $currency
     * @param string            $delimiter Delimiter between integer and fractional parts.
     *
     * @return string Raw amount ready for setting in Money object.
     */
    public function parse(string $amount, CurrencyInterface $currency, $delimiter = '.'): string;
}