<?php

/**
 * ArangoDB PHP Core Client: HTTP Request
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Connectors;

use frankmayer\ArangoDbPhpCore\Protocols\Http\RequestInterface;


/**
 * HTTP-Request object that holds a request. Requests are in some cases not directly passed to the server,
 * for instance when a request is destined for a batch.
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class Request extends \frankmayer\ArangoDbPhpCore\Protocols\Http\Request implements RequestInterface
{

}