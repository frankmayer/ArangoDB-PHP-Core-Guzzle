<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Client Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/ClientTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Tests\Integration\ClientIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;

//todo: fix tests


/**
 * Class ClientTest
 * @package frankmayer\ArangoDbPhpCore
 */
class ClientTest extends ClientIntegrationTest
{

    /**
     * @var Client
     */
    public $client;
    /**
     * @var Connector
     */
    public $connector;


    /**
     *
     */
    public function setUp()
    {
        $connector       = new Connector();
        $this->connector = $connector;
        $this->client    = getClient($connector);
    }

    /**
     *
     */
    public function tearDown()
    {
    }
}
