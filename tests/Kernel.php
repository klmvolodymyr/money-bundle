<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use VolodymyrKlymniuk\MoneyBundle\MoneyBundle;

class Kernel extends BaseKernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }


    public function getLogDir(): string
    {
        return $this->getProjectDir() . '/var/log';
    }


    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new MoneyBundle();
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
    }

    /**
     * @param ContainerBuilder $container
     * @param LoaderInterface  $loader
     *
     * @throws \Exception
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
    }

    /**
     * @param LoaderInterface $loader
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yaml');
    }
}
