<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Batch Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/IocTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Protocols\Http\HttpRequestInterface;
use frankmayer\ArangoDbPhpCore\Protocols\ResponseInterface;
use frankmayer\ArangoDbPhpCore\Tests\Integration\IocIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


/**
 * Class IocTest
 * @package frankmayer\ArangoDbPhpCore
 */
class IocTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\IocTest
{
    use TestCaseTrait;

    /**
     * @var Client
     */
    public $client;
    /**
     * @var
     */
    public $collectionNames;

    /**
     * @var HttpRequestInterface
     */
    public $request;

    /**
     * @var ResponseInterface
     */
    public $response;
    /**
     * @var
     */
    public $connector;


    /**
     *
     */
    public function setUp()
    {
        $connector       = new Connector();
        $this->connector = $connector;

        $this->client = \frankmayer\ArangoDbPhpCoreGuzzle\Tests\getClient($connector);
        $this->client->bind(
            'Request',
            function () {
                return $this->client->getRequest();
            }
        );
    }
}
