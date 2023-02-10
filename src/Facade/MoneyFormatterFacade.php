<?php

namespace VolodymyrKlymniuk\MoneyBundle\Facade;

use VolodymyrKlymniuk\MoneyBundle\Formatter\FormatterInterface;
use VolodymyrKlymniuk\MoneyBundle\Money\MoneyInterface;

/**
 * Class FormatterFacade
 *
 * Static facade for FormatterInterface
 *
 * @method static string format(MoneyInterface $money)
 * @see FormatterInterface::format()
 */
class MoneyFormatterFacade extends AbstractFacade
{
    protected static function getFacadeAccessor(): string
    {
        return FormatterInterface::class;
    }
}