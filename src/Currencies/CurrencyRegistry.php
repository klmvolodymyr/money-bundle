<?php

namespace VolodymyrKlymniuk\MoneyBundle\Currencies;

class CurrencyRegistry implements CurrenciesInterface
{
    /**
     * @var array
     */
    private $currencies = [];

    /**
     * CurrencyRegistry constructor.
     *
     * @param array $currencies
     *
     * @throws IncorrectCurrencyCodeException
     * @throws IncorrectCurrencyFractionalException
     */
    public function __construct(array $currencies)
    {
        foreach ($currencies as $currency) {
            $code = $currency['code'];
            $fractional = $currency['fractional'];

            if (!\is_string($code) || empty($code)) {
                throw new IncorrectCurrencyCodeException();
            }

            if (!\is_int($fractional) || $fractional < 0) {
                throw new IncorrectCurrencyFractionalException();
            }

            $this->currencies[$code] = $fractional;
        }
    }

    /**
     * Get fractional part of the currency. It could be used in currency formatting methods.
     *
     * @see \MoneyBundle\Formatter\MoneyFormatter::format()
     *
     * @param CurrencyInterface $currency
     *
     * @return int
     *
     * @throws CurrencyNotRegisteredException
     */
    public function fractionalFor(CurrencyInterface $currency): int
    {
        if (!$this->contains($currency)) {
            throw new CurrencyNotRegisteredException();
        }

        return $this->currencies[$currency->getCode()];
    }

    /**
     * @param CurrencyInterface $currency
     *
     * @return bool
     */
    public function contains(CurrencyInterface $currency): bool
    {
        return $this->containsCode($currency->getCode());
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    public function containsCode($code): bool
    {
        return \array_key_exists($code, $this->currencies);
    }
}
