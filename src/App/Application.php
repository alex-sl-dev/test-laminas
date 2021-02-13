<?php

/**
 * Copy and Paste some ideas from Laminas
 * But from scratch migrate to PSR
 *
 * @see       https://github.com/laminas/laminas-mvc for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc/blob/master/LICENSE.md New BSD License
 * https://github.com/laminas/laminas-mvc/blob/4.0.x/src/Application.php
 */

namespace Arego\App;


use Laminas\ConfigAggregator\ConfigAggregator;

use League\Container\Container;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class Application
{

    /**
     * @var ConfigAggregator 
     */
    protected ConfigAggregator $config;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * @var Router\RouteStackInterface
     */
    private Router\RouteStackInterface $router;

    /**
     * @var Container
     */
    private Container $container;

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    /**
     * Application constructor.
     * @param ConfigAggregator $config
     */
    public function __construct(ConfigAggregator $config)
    {
        $this->config = $config;
    }

    /**
     * Retrieve the application configuration
     *
     * @return ConfigAggregator 
     */
    public function getConfig(): ConfigAggregator
    {
        return $this->config;
    }

    public function bootstrap(array $listeners = [])
    {
        // invoke event boot
    }

    /**
     * Get the request object
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Get the response object
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     */
    public function useDispatcher()
    {
        $this->dispatcher = $this->container->get('EventDispatcher');
    }

    /**
     *
     */
    public function run()
    {
        // invoke event run
        dd($this);
    }

    /**
     */
    public function useRouter(): void
    {
        $this->router = $this->container->get('HttpRouter');
        $this->router->setRoutes($this->config->getMergedConfig()['routes']);
    }

    /**
     * @param Container $container
     */
    public function useContainer(Container $container)
    {
        $this->container = $container;
    }
}
