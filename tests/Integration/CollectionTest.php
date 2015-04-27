<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Collection Test
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once('ArangoDbPhpCoreGuzzleIntegrationTestCase.php');
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/CollectionTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Tests\Integration\CollectionIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use HttpResponse;

//todo: fix tests

/**
 * Class CollectionTest
 * @package frankmayer\ArangoDbPhpCore
 */
class CollectionTest extends CollectionIntegrationTest
{
    /**
     * @var Client
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
        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-CollectionViaIocContainer';
        $collection     = new Collection($this->client);

        /** @var $responseObject HttpResponse */
        $collection->drop($collectionName);
    }
}
