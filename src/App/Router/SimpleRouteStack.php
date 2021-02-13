<?php


namespace Arego\App\Router;


use InvalidArgumentException;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Stdlib\PriorityList;
use Psr\Http\Message\RequestInterface;
use Traversable;

/**
 * @deprecated
 * Class SimpleRouteStack
 * @package Arego\App\Router
 */
class SimpleRouteStack implements RouteStackInterface
{
    /**
     * Stack containing all routes.
     *
     * @var PriorityList
     */
    protected PriorityList $routes;

    /**
     * Default parameters.
     *
     * @var array
     */
    protected array $defaultParams = [];

    public function __construct()
    {
        $this->routes = new PriorityList();
    }

    /**
     * @param RequestInterface $request
     * @return RouteMatch|void|null
     */
    public function match(RequestInterface $request): ?RouteMatch
    {
        foreach ($this->routes as $name => $route) {
            /** @var $route RouteInterface */
            if (($match = $route->match($request)) instanceof RouteMatch) {
                /** @var $match RouteMatch */
                $match->setMatchedRouteName($name);

                foreach ($this->defaultParams as $paramName => $value) {
                    if ($match->getParam($paramName) === null) {
                        $match->setParam($paramName, $value);
                    }
                }

                return $match;
            }
        }

        return null;
    }

    public function addRoute($name, $route, $priority = null): RouteStackInterface
    {
        if (! $route instanceof RouteInterface) {
            $route = $this->routeFromArray($route);
        }

        if ($priority === null && isset($route->priority)) {
            $priority = $route->priority;
        }

        $this->routes->insert($name, $route, $priority);

        return $this;

    }

    /**
     * Create a route from array specifications.
     *
     * @param  array|Traversable $specs
     * @return RouteInterface
     * @throws InvalidArgumentException
     */
    protected function routeFromArray($specs): RouteInterface
    {
        if ($specs instanceof Traversable) {
            $specs = ArrayUtils::iteratorToArray($specs);
        }

        if (! is_array($specs)) {
            throw new InvalidArgumentException('Route definition must be an array or Traversable object');
        }

        /*
        if (! isset($specs['type'])) {
            throw new InvalidArgumentException('Missing "type" option');
        }
        */

        if (! isset($specs['options'])) {
            $specs['options'] = [];
        }

        //dd($specs);
        //$route = $this->getRoutePluginManager()->get($specs['type'], $specs['options']);

        $route = new $specs['handler'];
        dd($route);
        /*
        if (isset($specs['priority'])) {
            $route->priority = $specs['priority'];
        }
        */

        return $route;
    }

    /**
     * @param array|Traversable $routes
     * @return RouteStackInterface
     */
    public function addRoutes($routes): RouteStackInterface
    {
        if (! is_array($routes) && ! $routes instanceof Traversable) {
            throw new InvalidArgumentException('addRoutes expects an array or Traversable set of routes');
        }

        foreach ($routes as $name => $route) {
            $this->addRoute($name, $route);
        }

        return $this;
    }

    public function removeRoute($name): RouteStackInterface
    {
        // TODO: Implement removeRoute() method.
    }

    /**
     * @param array|Traversable $routes
     * @return RouteStackInterface
     */
    public function setRoutes($routes): RouteStackInterface
    {
        $this->routes->clear();
        $this->addRoutes($routes);

        return $this;
    }
}
