<?php

namespace VolodymyrKlymniuk\MoneyBundle\Facade;

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
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ParserInterface::class;
    }
}
