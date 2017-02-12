<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Async Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
//require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/AsyncTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


/**
 * Class AsyncTest
 * @package frankmayer\ArangoDbPhpCore
 */
class AsyncTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\AsyncTest
{
   use TestCaseTrait;

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
        $this->client = \frankmayer\ArangoDbPhpCoreGuzzle\Tests\getClient($connector);
    }


//    /**
//     *
//     */
//    public function tearDown()
//    {
//        $collectionName = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-Collection';
//
//
//        $collection = new Collection($this->client);
//
//        /** @var $responseObject HttpResponse */
//        $collection->drop($collectionName);
//    }
}
