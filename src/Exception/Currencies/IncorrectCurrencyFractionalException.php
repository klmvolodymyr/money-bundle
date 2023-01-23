<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception\Currencies;

class IncorrectCurrencyFractionalException extends MoneyException
{
    /**
     * @var string
     */
    protected $message = 'Currency fractional have to be positive integer';
}
