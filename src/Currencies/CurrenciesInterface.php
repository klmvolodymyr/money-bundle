<?php

namespace VolodymyrKlymniuk\MoneyBundle\Currencies;

use VolodymyrKlymniuk\MoneyBundle\Exception\Currencies\CurrencyNotRegisteredException;
use VolodymyrKlymniuk\MoneyBundle\Money\CurrencyInterface;

interface CurrenciesInterface
{
    /**
     * Checks whether a currency is available in the current context.
     *
     * @param CurrencyInterface $currency
     *
     * @return bool
     */
    public function contains(CurrencyInterface $currency): bool;

    /**
     * Checks whether a currency code is available in the current context.
     *
     * @param string $code
     *
     * @return bool
     */
    public function containsCode(string $code): bool;

    /**
     * Returns the subunit for a currency.
     *
     * @param CurrencyInterface $currency
     *
     * @return int
     *
     * @throws CurrencyNotRegisteredException If currency is not available in the current context
     */
    public function fractionalFor(CurrencyInterface $currency): int;
}