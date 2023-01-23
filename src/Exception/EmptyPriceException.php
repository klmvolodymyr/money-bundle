<?php

namespace VolodymyrKlymniuk\MoneyBundle\Exception;

class EmptyPriceException extends \DomainException
{
    /**
     * @var string
     */
    protected $message = 'Price property is not setup. Load first.';
}
