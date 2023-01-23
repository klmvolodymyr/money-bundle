<?php

namespace VolodymyrKlymniuk\MoneyBundle\Money;

/**
 * Interface for money value object. Store amount in string in currency minimal unit like Money PHP library do.
 *
 * @see https://github.com/moneyphp/money
 *
 * Examples of internal amount value:
 *  - 10000 for 100.00 USD
 *  - 11042 for 110.42 USD
 *  - 424242 for 4242.42 UAH
 *  - 1240000000000000000 for 1.24 ETH (Ethereum)
 *
 * Interface MoneyInterface
 */
interface MoneyInterface
{
    /**
     * Create money object from provided amount and currency. Amount could be provided with fractional part.
     * Examples of $amount input argument:
     *  - 100.10 is 100 dollars and 10 cents for USD.
     *  - 1.12 is 1.12 ether for ETH or 1120000000000000000 wei.
     *  - 1.42 is 1.42 bitcoins for BTC or 142000000 satoshi.
     *
     * @param string $amount
     * @param string $currencyCode
     * @param string $delimiter
     *
     * @return MoneyInterface
     */
    public static function create(string $amount, string $currencyCode, string $delimiter = '.'): MoneyInterface;

    /**
     * Create money object from provided raw amount and currency code.
     * Example of $rawAmount input argument:
     *  - 10000 for 100.00 USD
     *  - 11042 for 110.42 USD
     *  - 424242 for 4242.42 UAH
     *  - 1240000000000000000 for 1.24 ETH (Ethereum)
     *
     * @param string $rawAmount
     * @param string $currencyCode
     *
     * @return MoneyInterface
     */
    public static function createFromRaw($rawAmount, string $currencyCode): MoneyInterface;

    /**
     * @see FormatterInterface
     *
     * Raw amount - don't forget to use formatter.
     * Examples of return value:
     *  - 10000 for 100.00 USD
     *  - 11042 for 110.42 USD
     *  - 424242 for 4242.42 UAH
     *  - 1240000000000000000 for 1.24 ETH (Ethereum)
     *
     * @return string
     */
    public function getAmount(): string;

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * Checks whether the value represented by this object equals to the other.
     *
     * @param MoneyInterface $other
     *
     * @return bool
     */
    public function equals(MoneyInterface $other): bool;

    /**
     * Checks whether a Money has the same Currency as this.
     *
     * @param MoneyInterface $other
     *
     * @return bool
     */
    public function isSameCurrency(MoneyInterface $other): bool;

    /**
     * Returns formatted currency with fractional part.
     * Examples return value:
     *  - 100.10 is 100 dollars and 10 cents for USD.
     *  - 1.12 is 1.12 ether for ETH or 1120000000000000000 wei.
     *  - 1.42 is 1.42 bitcoins for BTC or 142000000 satoshi.
     *
     * @return string
     */
    public function format(): string;
}