<?php

namespace Arego\App\ServiceProviders;

use Arego\App\Router\RouterFactory;
use Arego\App\Router\RouteStackInterface;
use Arego\App\Router\SimpleRouteStack;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;


/**
 * Class HttpRouterServiceProvider
 * @package Arego\App\ServiceProviders
 */
class HttpRouterServiceProvider
    extends AbstractServiceProvider
    implements BootableServiceProviderInterface
{

    /**
     * The provided array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        //'Arego\App\Router\SimpleRouterStack'
        SimpleRouteStack::class
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    public function boot()
    {
        /*
        $this->getContainer()
             ->inflector(RouterFactory::class)
             ->invokeMethod('factory', []);
        */
        $this->getContainer()->add('HttpRouter',
            SimpleRouteStack::class);
    }
}
