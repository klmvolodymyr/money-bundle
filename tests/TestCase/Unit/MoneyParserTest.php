<?php

namespace Tests\TestCase\Unit;

use PHPUnit\Framework\TestCase;
use VolodymyrKlymniuk\MoneyBundle\Currencies\CurrencyRegistry;
use VolodymyrKlymniuk\MoneyBundle\Exception\Currencies\CurrencyNotRegisteredException;
use VolodymyrKlymniuk\MoneyBundle\Money\Currency;
use VolodymyrKlymniuk\MoneyBundle\Parser\MoneyParser;
use VolodymyrKlymniuk\MoneyBundle\Parser\ParserInterface;

class MoneyParserTest extends TestCase
{
    /**
     * @param ParserInterface $parser
     *
     * @dataProvider parserProvider
     */
    public function testParseWithFractional(ParserInterface $parser): void
    {
        $currency = new Currency('USD');
        $rawAmount = $parser->parse('100.01', $currency);

        $this->assertEquals('10001', $rawAmount);
    }

    /**
     * @param ParserInterface $parser
     *
     * @dataProvider parserProvider
     */
    public function testParseWithoutFractional(ParserInterface $parser): void
    {
        $currency = new Currency('ETH');
        $rawAmount = $parser->parse('1', $currency);

        $this->assertEquals('1000000000000000000', $rawAmount);
    }

    /**
     * @param ParserInterface $parser
     *
     * @dataProvider parserProvider
     */
    public function testParseWithNonFullFractional(ParserInterface $parser): void
    {
        $currency = new Currency('USD');
        $rawAmount = $parser->parse('100.4', $currency);

        $this->assertEquals('10040', $rawAmount);
    }

    /**
     * @param ParserInterface $parser
     *
     * @dataProvider parserProvider
     */
    public function testParseException(ParserInterface $parser)
    {
        $currency = new Currency('BYN');

        $this->expectException(CurrencyNotRegisteredException::class);
        $parser->parse('100.50', $currency);
    }

    /**
     * @return array
     */
    public function parserProvider(): array
    {
        $currenciesList = [
            ['code' => 'ETH', 'fractional' => 18],
            ['code' => 'USD', 'fractional' => 2],
        ];

        $currencies = new CurrencyRegistry($currenciesList);
        $formatter = new MoneyParser($currencies);

        return [
            [
                $formatter,
            ],
        ];
    }
}
