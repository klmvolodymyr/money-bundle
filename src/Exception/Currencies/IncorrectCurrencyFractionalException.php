<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception\Currencies;

use VolodymyrKlymniuk\MoneyBundle\Exception\MoneyException;

class IncorrectCurrencyFractionalException extends MoneyException
{
    /**
     * @var string
     */
    protected $message = 'Currency fractional have to be positive integer';
}
