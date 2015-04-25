<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Batch Test
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once('ArangoDbPhpCoreGuzzleIntegrationTestCase.php');
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
        $this->client = $this->client = getClient($connector);

        $this->collectionNames[0] = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection-01';
        $this->collectionNames[1] = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection-02';
        $this->collectionNames[2] = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection-03';
    }

    /**
     *
     */
    public function tearDown()
    {
        $batchParts = [];
        foreach ($this->collectionNames as $collectionName) {
            $collection         = new Collection($this->client);
            $collection->client = $this->client;

            /** @var $responseObject HttpResponse */
            $batchParts[] = $collection->drop($collectionName, ['isBatchPart' => true]);
        }
        $batch = new Batch($this->client);
        $batch->send($this->client, $batchParts);
    }
}