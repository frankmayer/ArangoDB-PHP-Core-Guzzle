<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Plugin Test
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/PluginTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientOptions;
use frankmayer\ArangoDbPhpCore\Tests\Integration\PluginIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


/**
 * Class PluginTest
 * @package frankmayer\ArangoDbPhpCore
 */
class PluginTest extends PluginIntegrationTest
{
    /**
     * @var ClientOptions $clientOptions
     */
    public $clientOptions;

    /**
     * @var Client $client
     */
    public $client;


    /**
     *
     */
    public function setUp()
    {
        $connector    = new Connector();
        $this->client = getClient($connector);
    }


    /**
     *
     */
    public function tearDown()
    {
    }
}
