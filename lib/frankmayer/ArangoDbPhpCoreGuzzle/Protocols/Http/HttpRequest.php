<?php

/**
 * ArangoDB PHP Core Client: HTTP Request
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http;

use frankmayer\ArangoDbPhpCore\Protocols\Http\HttpRequestInterface;


/**
 * HTTP-Request object that holds a request. Requests are in some cases not directly passed to the server,
 * for instance when a request is destined for a batch.
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class HttpRequest extends \frankmayer\ArangoDbPhpCore\Protocols\Http\HttpRequest implements HttpRequestInterface
{

}