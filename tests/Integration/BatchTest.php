<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Batch Test
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/BatchTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Batch;
use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Tests\Integration\BatchIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpResponse;


/**
 * Class BatchTest
 * @package frankmayer\ArangoDbPhpCore
 */
class BatchTest extends BatchIntegrationTest
{
    /**
     * @var
     */
    public $client;
    /**
     * @var
     */
    public $collectionNames;


    /**
     *
     */
    public function setUp()
    {
        $connector    = new Connector();
        $this->client = getClient($connector);

        $this->collectionNames[0] = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-Collection-01';
        $this->collectionNames[1] = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-Collection-02';
        $this->collectionNames[2] = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-Collection-03';
    }

    /**
     *
     */
    public function tearDown()
    {
        $batchParts = [];
        foreach ($this->collectionNames as $collectionName) {
            $collection = new Collection($this->client);

            /** @var $responseObject HttpResponse */
            $batchParts[] = $collection->drop($collectionName, ['isBatchPart' => true]);
        }
        $batch = new Batch($this->client);
        $batch->send($this->client, $batchParts);
    }
}
