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
use frankmayer\ArangoDbPhpCore\ClientOptions;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpResponse;
use GuzzleHttp\Promise\Promise;


/**
 * Class AsyncTest
 *
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
     * Override-able connector setup
     */
    protected function setupConnector()
    {
        $this->connector = new Connector();
    }

    public function setupProperties()
    {
        $this->clientOptions = ($this->TESTS_NAMESPACE . 'getClientOptions')();

        if (($envVar = getenv('ArangoDB-PHP-Core-Async-Processing') === false) || $envVar !== 'true') {
            $this->client = new Client($this->connector, $this->clientOptions);
        } else {
            $this->client = \frankmayer\ArangoDbPhpCoreGuzzle\Tests\getClient($this->connector, [ClientOptions::OPTION_CLIENT_ASYNC_PROCESSING => true]);
        }
    }


    /**
     *
     */
    public function tearDown()
    {
        $collectionName = ArangoDbPhpCoreGuzzleIntegrationTestCase::TESTNAMES_PREFIX . 'CollectionTestSuite-Collection';
        $collection     = new Collection($this->client);

        /** @var $responseObject HttpResponse */
        $result = $collection->drop($collectionName);
        $result = $this->resolveResponse($result);
    }

    /**
     * @param $responseObject
     *
     * @return HttpResponse|Promise
     */
    protected function resolveResponse($responseObject)
    {
        if ($responseObject instanceof Promise) {
            return $responseObject->wait();
        } else {
            return $responseObject;
        }
    }
}
