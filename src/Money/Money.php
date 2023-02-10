<?php

namespace VolodymyrKlymniuk\MoneyBundle\Money;

use VolodymyrKlymniuk\MoneyBundle\Exception\IncorrectAmountTypeException;
use VolodymyrKlymniuk\MoneyBundle\Facade\MoneyFormatterFacade;
use VolodymyrKlymniuk\MoneyBundle\Facade\MoneyParserFacade;

class Money implements MoneyInterface
{
    /**
     * @var string
     */
    private $amount;

    /**
     * @var CurrencyInterface
     */
    private $currency;

    /**
     * Money constructor.
     *
     * @param string|int        $amount
     * @param CurrencyInterface $currency
     *
     * @throws IncorrectAmountTypeException
     */
    public function __construct($amount, CurrencyInterface $currency)
    {
        $isInteger = \is_int($amount) || \ctype_digit($amount);
        if (!$isInteger) {
            throw new IncorrectAmountTypeException();
        }

        $this->amount = (string) $amount;
        $this->currency = $currency;
    }

    /**
     * @inheritdoc
     *
     * @throws IncorrectAmountTypeException
     */
    public static function createFromRaw($rawAmount, string $currencyCode): MoneyInterface
    {
        $currency = new Currency($currencyCode);

        return new static($rawAmount, $currency);
    }

    /**
     * @inheritdoc
     *
     * @throws IncorrectAmountTypeException
     */
    public static function create(string $amount, string $currencyCode, string $delimiter = '.'): MoneyInterface
    {
        $currency = new Currency($currencyCode);
        $rawAmount = MoneyParserFacade::parse($amount, $currency, $delimiter);

        return new static($rawAmount, $currency);
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * Checks whether the value represented by this object equals to the other.
     *
     * @param MoneyInterface $other
     *
     * @return bool
     */
    public function equals(MoneyInterface $other): bool
    {
        return $this->isSameCurrency($other) && $this->getAmount() === $other->getAmount();
    }

    /**
     * Checks whether a Money has the same Currency as this.
     *
     * @param MoneyInterface $other
     *
     * @return bool
     */
    public function isSameCurrency(MoneyInterface $other): bool
    {
        return $this->currency->equals($other->getCurrency());
    }

    /**
     * @inheritdoc
     */
    public function format(): string
    {
        return MoneyFormatterFacade::format($this);
    }
}