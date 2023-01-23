<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception;

class MoneyException extends \DomainException
{
    /**
     * @var int
     */
    protected $code = 400;
}
