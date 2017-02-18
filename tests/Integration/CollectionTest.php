<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Collection Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
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
class CollectionTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\CollectionTest
{
    use TestCaseTrait;

    /**
     * @var Client
     */
    public $client;


    /**
     * Override-able connector setup
     */
    protected function setupConnector()
    {
        $this->connector = new Connector();
    }


    /**
     *
     */
    public function tearDown()
    {
        $collectionName = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-CollectionViaIocContainer';
        $collection     = new Collection($this->client);

        /** @var $responseObject HttpResponse */
        $result = $collection->drop($collectionName);
        $result = $this->resolveResponse($result);

    }
}
