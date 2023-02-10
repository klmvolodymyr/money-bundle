<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception\Currencies;

use VolodymyrKlymniuk\MoneyBundle\Exception\MoneyException;

class IncorrectCurrencyCodeException extends MoneyException
{
    /**
     * @var string
     */
    protected $message = 'Currency code have to be string and not empty';
}