<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Document Test
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;


require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/DocumentTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientException;
use frankmayer\ArangoDbPhpCore\Tests\Integration\DocumentIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use HttpResponse;


/**
 * Class DocumentTest
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class DocumentTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\DocumentTest
{
    use TestCaseTrait;

    /**
     * @var Client
     */
    public $client;


    /**
     * @throws ClientException
     */
    public function setUp()
    {
        $this->connector = new Connector($this->client);
        $this->setupProperties();

        $collectionName = $this->TESTNAMES_PREFIX . 'CollectionTestSuite-Collection';

        $collectionOptions    = ['waitForSync' => true];
        $collectionParameters = [];
        $options              = $collectionOptions;
        $this->client->bind(
            'Request',
            function () {
                return $this->client->getRequest();
            }
        );


        $request          = $this->client->make('Request');
        $request->options = $options;
        $request->body    = ['name' => $collectionName];

        $request->body = self::array_merge_recursive_distinct($request->body, $collectionParameters);
        $request->body = json_encode($request->body);

        $request->path   = $this->client->fullDatabasePath . self::API_COLLECTION;
        $request->method = self::METHOD_POST;

        $responseObject = $request->send();

        $body = $responseObject->body;

        $this->assertArrayHasKey('code', json_decode($body, true));
        $decodedJsonBody = json_decode($body, true);
        $this->assertEquals(200, $decodedJsonBody['code']);
        $this->assertEquals($collectionName, $decodedJsonBody['name']);
    }


    /**
     * @throws ClientException
     */
    public function tearDown()
    {
        $collectionName = $this->TESTNAMES_PREFIX . 'CollectionTestSuite-Collection';

        $collectionOptions = ['waitForSync' => true];
        $options           = $collectionOptions;
        $this->client->bind(
            'Request',
            function () {
                return $this->client->getRequest();
            }
        );


        $request          = $this->client->make('Request');
        $request->options = $options;
        $request->path    = $this->client->fullDatabasePath . self::API_COLLECTION . '/' . $collectionName;
        $request->method  = self::METHOD_DELETE;

        /** @var HttpResponse $responseObject */
        $responseObject = $request->send();
        $responseObject = $this->resolveResponse($responseObject);

        $body = $responseObject->body;

        $this->assertArrayHasKey('code', json_decode($body, true));

        $decodedJsonBody = json_decode($body, true);

        $this->assertEquals(200, $decodedJsonBody['code']);

        $collectionName = $this->TESTNAMES_PREFIX . 'CollectionTestSuite-NonExistingCollection';
        $collection     = new Collection($this->client);

        /** @var $responseObject HttpResponse */
        $result=$collection->drop($collectionName);
        $result = $this->resolveResponse($result);

    }
}
