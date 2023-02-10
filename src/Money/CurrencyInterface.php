<?php

namespace VolodymyrKlymniuk\MoneyBundle\Money;

interface CurrencyInterface
{
    public function getCode(): string;

    /**
     * Checks whether this currency is the same as an other.
     */
    public function equals(CurrencyInterface $other): bool;
}