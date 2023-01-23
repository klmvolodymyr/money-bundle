<?php

namespace VolodymyrKlymniuk\MoneyBundle\Facade;

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
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FormatterInterface::class;
    }
}