<?php


namespace Arego\App\Router;


use Agero\App\Http\Method;

class Route
{

    public string $httpMethod; // maybe just a verb

    public string  $handler;
    private array $methods;
    private string $pattern;

    public static function get(string $pattern, string $handler): self
    {
        return self::methods([Method::GET], $pattern);
    }

    private static function methods(array $methods, string $pattern)
    {
        $route = new self($dispatcher);
        $route->methods = $methods;
        $route->pattern = $pattern;
        if ($middlewareDefinition !== null) {
            $route->middlewareDefinitions[] = $middlewareDefinition;
        }
        return $route;
    }
}
