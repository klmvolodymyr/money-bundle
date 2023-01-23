<?php

namespace VolodymyrKlymniuk\MoneyBundle\Formatter;

class MoneyFormatter implements FormatterInterface
{
    /**
     * @var CurrenciesInterface
     */
    private $currencies;

    /**
     * MoneyFormatter constructor.
     *
     * @param CurrenciesInterface $currencies
     */
    public function __construct(CurrenciesInterface $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @param MoneyInterface $money
     *
     * @return string
     *
     * @throws CurrencyNotRegisteredException
     */
    public function format(MoneyInterface $money): string
    {
        $fractionalSize = $this->getFractional($money);

        $amount = $money->getAmount();
        $baseAmount = $this->getBaseAmount($amount);
        $valueLength = \strlen($baseAmount);

        /** If total value length lesser than fractional size - we need to place leading zero in formatted number. */
        if ($valueLength > $fractionalSize) {
            $formatted = \substr($baseAmount, 0, $valueLength - $fractionalSize);
            $decimalDigits = \substr($baseAmount, $valueLength - $fractionalSize);
            if (\strlen($decimalDigits) > 0) {
                $formatted .= '.' . $decimalDigits;
            }
        } else {
            $formatted = '0.' . str_pad('', $fractionalSize - $valueLength, '0') . $baseAmount;
        }
        if ($this->isNegativeAmount($amount)) {
            $formatted = '-' . $formatted;
        }

        return $formatted;
    }

    /**
     * @param MoneyInterface $money
     *
     * @return string
     *
     * @throws CurrencyNotRegisteredException
     */
    private function getFractional(MoneyInterface $money): string
    {
        return $this->currencies->fractionalFor($money->getCurrency());
    }

    /**
     * @param string $amount
     *
     * @return string
     */
    private function getBaseAmount(string $amount): string
    {
        $isNegativeAmount = $this->isNegativeAmount($amount);
        if ($isNegativeAmount) {
            return substr($amount, 1);
        }

        return $amount;
    }

    /**
     * @param string $amount
     *
     * @return bool
     */
    private function isNegativeAmount(string $amount): bool
    {
        return $amount[0] === '-';
    }
}