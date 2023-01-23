<?php

namespace VolodymyrKlymniuk\MoneyBundle\Facade;

use Psr\Container\ContainerInterface;

abstract class AbstractFacade
{
    protected static $container;

    /**
     * @return string
     */
    abstract protected static function getFacadeAccessor(): string;

    /**
     * Facade service container.
     *
     * @param ContainerInterface $container
     */
    public static function setFacadeContainer(ContainerInterface $container): void
    {
        static::$container = $container;
    }

    /**
     * Handle dynamic calls to the service.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $arguments)
    {
        $service = static::$container->get(static::getFacadeAccessor());

        return $service->$method(...$arguments);
    }
}