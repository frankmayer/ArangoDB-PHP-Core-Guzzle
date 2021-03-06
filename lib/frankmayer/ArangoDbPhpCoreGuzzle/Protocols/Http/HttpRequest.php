<?php

/**
 * ArangoDB PHP Core Client: HTTP Request
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http;

use frankmayer\ArangoDbPhpCore\Protocols\Http\HttpRequestInterface;
use GuzzleHttp\Psr7\Response;


/**
 * HTTP-Request object that holds a request. Requests are in some cases not directly passed to the server,
 * for instance when a request is destined for a batch.
 *
 * @package frankmayer\ArangoDbPhpCoreGuzzle
 */
class HttpRequest extends \frankmayer\ArangoDbPhpCore\Protocols\Http\HttpRequest implements HttpRequestInterface
{
    /**
     * @var Response|string The response data as a result of the request
     */
    public $response;

}