<?php

namespace VolodymyrKlymniuk\MoneyBundle\Money;

class Currency implements CurrencyInterface
{
    /**
     * Currency code.
     *
     * @var string
     */
    private $code;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Returns the currency code.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Checks whether this currency is the same as an other.
     *
     * @param CurrencyInterface $other
     *
     * @return bool
     */
    public function equals(CurrencyInterface $other): bool
    {
        return $this->getCode() === $other->getCode();
    }
}