<?php


namespace Agero\App\Http;


use Psr\Http\Message\ResponseInterface;


/**
 * Class Response
 * @package Agero\App\Http
 */
class Response extends Message implements ResponseInterface
{

    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }
}
