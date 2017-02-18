<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Client Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/ClientTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientOptions;
use frankmayer\ArangoDbPhpCore\Protocols\Http\HttpResponse;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use GuzzleHttp\Promise\Promise;

//todo: fix tests


/**
 * Class ClientTest
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class ClientTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\ClientTest
{
use TestCaseTrait;
    /**
     * @var Client
     */
    public $client;
    /**
     * @var Connector
     */
    public $connector;

    public function setUp()
    {
        $this->connector = new Connector();
        $this->setupProperties();
    }

    /**
     * Test if the client returns a promise, if used asynchronously
     */
    public function testAsyncCapableClientUsedAsynchronouslyReturnPromise()
    {
        $client         = \frankmayer\ArangoDbPhpCoreGuzzle\Tests\getClient($this->connector, [ClientOptions::OPTION_CLIENT_ASYNC_PROCESSING => true]);
        $collection     = new Collection($client);
        $responseObject = $collection->getAll();

        static::assertInstanceOf('GuzzleHttp\Promise\Promise', $responseObject);
    }

    /**
     * Test if the client returns an HttpResponse if used syncronously.
     */
    public function testAsyncCapableClientUsedSynchronouslyReturnHttpResponse()
    {
        $client         = \frankmayer\ArangoDbPhpCoreGuzzle\Tests\getClient($this->connector, [ClientOptions::OPTION_CLIENT_ASYNC_PROCESSING => false]);
        $collection     = new Collection($client);
        $responseObject = $collection->getAll();

        static::assertInstanceOf('frankmayer\ArangoDbPhpCore\Protocols\Http\HttpResponse', $responseObject);
    }
}
