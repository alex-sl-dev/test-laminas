<?php
namespace Arego\App\Router;

interface RouteInterface
{

    /**
     * Match a given request.
     *
     * @return RouteMatch|null
     */
    public function match(\Psr\Http\Message\RequestInterface $request);
}
