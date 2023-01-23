<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception\Currencies;

use VolodymyrKlymniuk\MoneyBundle\Exception\MoneyException;

class CurrencyNotRegisteredException extends MoneyException
{
    /**
     * @var string
     */
    protected $message = 'Currency is not registered in CurrencyRegistry';
}