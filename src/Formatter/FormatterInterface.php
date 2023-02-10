<?php

namespace VolodymyrKlymniuk\MoneyBundle\Formatter;

use VolodymyrKlymniuk\MoneyBundle\Money\MoneyInterface;

interface FormatterInterface
{
    /**
     * Returns formatted currency with fractional part.
     * Examples return value:
     *  - 100.10 is 100 dollars and 10 cents for USD.
     *  - 1.12 is 1.12 ether for ETH or 1120000000000000000 wei.
     *  - 1.42 is 1.42 bitcoins for BTC or 142000000 satoshi.
     *
     * @return string
     *
     * @param MoneyInterface $money
     *
     * @return string
     */
    public function format(MoneyInterface $money): string;
}