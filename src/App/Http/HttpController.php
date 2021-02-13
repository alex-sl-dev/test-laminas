<?php

namespace Agero\App\Http;

use League\Event\EventDispatcher;
use League\Event\EventDispatcherAware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HttpController implements RequestHandlerInterface, EventDispatcherAware
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // TODO: Implement handle() method.
        return new Response();
    }

    public function useEventDispatcher(EventDispatcher $dispatcher): void
    {
        // TODO: Implement useEventDispatcher() method.
    }

    public function eventDispatcher(): EventDispatcher
    {
        // TODO: Implement eventDispatcher() method.
    }
}
