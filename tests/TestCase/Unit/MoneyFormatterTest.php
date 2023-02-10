<?php

namespace Tests\TestCase\Unit;

use PHPUnit\Framework\TestCase;
use VolodymyrKlymniuk\MoneyBundle\Currencies\CurrencyRegistry;
use VolodymyrKlymniuk\MoneyBundle\Exception\Currencies\CurrencyNotRegisteredException;
use VolodymyrKlymniuk\MoneyBundle\Formatter\FormatterInterface;
use VolodymyrKlymniuk\MoneyBundle\Formatter\MoneyFormatter;
use VolodymyrKlymniuk\MoneyBundle\Money\Currency;
use VolodymyrKlymniuk\MoneyBundle\Money\Money;

class MoneyFormatterTest extends TestCase
{
    /**
     * @param FormatterInterface $formatter
     *
     * @dataProvider formatterProvider
     */
    public function testFormat(FormatterInterface $formatter)
    {
        $currency = new Currency('USD');
        $money = new Money('10000', $currency);
        $this->assertEquals('100.00', $formatter->format($money));

        $currency = new Currency('ETH');
        $money = new Money('1000000000000000000', $currency);
        $this->assertEquals('1.000000000000000000', $formatter->format($money));

        $currency = new Currency('USD');
        $money = new Money('10050', $currency);
        $this->assertEquals('100.50', $formatter->format($money));

        $currency = new Currency('ETH');
        $money = new Money('1200000000000000000', $currency);
        $this->assertEquals('1.200000000000000000', $formatter->format($money));
    }

    /**
     * @param FormatterInterface $formatter
     *
     * @dataProvider formatterProvider
     */
    public function testCurrencyNotRegisteredException(FormatterInterface $formatter)
    {
        $currency = new Currency('BYN');
        $money = new Money('100500', $currency);
        $this->expectException(CurrencyNotRegisteredException::class);

        $formatter->format($money);
    }

    /**
     * @return array
     */
    public function formatterProvider(): array
    {
        $currenciesList = [
            ['code' => 'ETH', 'fractional' => 18],
            ['code' => 'USD', 'fractional' => 2],
        ];

        $currencies = new CurrencyRegistry($currenciesList);
        $formatter = new MoneyFormatter($currencies);

        return [
            [
                $formatter,
            ],
        ];
    }
}
