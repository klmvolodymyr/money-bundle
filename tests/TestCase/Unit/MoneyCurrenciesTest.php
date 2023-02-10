<?php

namespace Tests\TestCase\Unit;

use PHPUnit\Framework\TestCase;
use VolodymyrKlymniuk\MoneyBundle\Currencies\CurrenciesInterface;
use VolodymyrKlymniuk\MoneyBundle\Currencies\CurrencyRegistry;
use VolodymyrKlymniuk\MoneyBundle\Exception\Currencies\CurrencyNotRegisteredException;
use VolodymyrKlymniuk\MoneyBundle\Money\Currency;

class MoneyCurrenciesTest extends TestCase
{
    /**
     * @param CurrenciesInterface $currencies
     *
     * @dataProvider currenciesProvider
     */
    public function testContains(CurrenciesInterface $currencies): void
    {
        $currency = new Currency('ETH');
        $this->assertEquals(true, $currencies->contains($currency));
    }

    /**
     * @param CurrenciesInterface $currencies
     *
     * @dataProvider currenciesProvider
     */
    public function testNotContains(CurrenciesInterface $currencies): void
    {
        $currency = new Currency('BYR');
        $this->assertEquals(false, $currencies->contains($currency));
    }

    /**
     * @param CurrenciesInterface $currencies
     *
     * @dataProvider currenciesProvider
     */
    public function testFractionalFor(CurrenciesInterface $currencies): void
    {
        $currency = new Currency('USD');
        $this->assertEquals(2, $currencies->fractionalFor($currency));
    }

    /**
     * @param CurrenciesInterface $currencies
     *
     * @dataProvider currenciesProvider
     */
    public function testFractionalForException(CurrenciesInterface $currencies): void
    {
        $currency = new Currency('BYR');

        $this->expectException(CurrencyNotRegisteredException::class);
        $currencies->fractionalFor($currency);
    }

    /**
     * @return array
     */
    public function currenciesProvider(): array
    {
        $currenciesList = [
            ['code' => 'ETH', 'fractional' => 18],
            ['code' => 'USD', 'fractional' => 2],
        ];

        $currencies = new CurrencyRegistry($currenciesList);

        return [
            [
                $currencies,
            ],
        ];
    }
}