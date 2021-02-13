<?php

namespace Arego\App\Router;


use Psr\Container\ContainerInterface;


class RouterFactory
{
/**
     * Create and return the router
     *
     * Delegates to the HttpRouter service.
     *
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     * @return RouteStackInterface
     */
    public function factory(ContainerInterface $container, $name, array $options = null): RouteStackInterface
    {
        return $container->get('HttpRouter');
    }
}
