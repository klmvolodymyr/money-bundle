<?php

namespace VolodymyrKlymniuk\MoneyBundle\Facade;

use VolodymyrKlymniuk\MoneyBundle\Money\CurrencyInterface;
use VolodymyrKlymniuk\MoneyBundle\Parser\ParserInterface;

/**
 * Class MoneyParserFacade
 *
 * Static facade for ParserInterface
 *
 * @method static string parse(string $amount, CurrencyInterface $currency, $delimiter = '.')
 * @see ParserInterface::parse()
 */
class MoneyParserFacade extends AbstractFacade
{
    protected static function getFacadeAccessor(): string
    {
        return ParserInterface::class;
    }
}
