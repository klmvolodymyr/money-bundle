<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception;

class IncorrectAmountTypeException extends MoneyException
{
    /**
     * @var string
     */
    protected $message = 'Amount have to be number or numeric string without fractional';
}