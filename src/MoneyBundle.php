<?php

namespace VolodymyrKlymniuk\MoneyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use VolodymyrKlymniuk\MoneyBundle\Facade\AbstractFacade;

class MoneyBundle extends Bundle
{
    public function boot()
    {
        AbstractFacade::setFacadeContainer($this->container);
    }
}