<?php

namespace VolodymyrKlymniuk\MoneyBundle\Money;

interface CurrencyInterface
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * Checks whether this currency is the same as an other.
     *
     * @param CurrencyInterface $other
     *
     * @return bool
     */
    public function equals(CurrencyInterface $other): bool;
}