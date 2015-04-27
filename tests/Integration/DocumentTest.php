<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Document Test
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;


require_once('ArangoDbPhpCoreGuzzleIntegrationTestCase.php');
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/DocumentTest.php';

use frankmayer\ArangoDbPhpCore\Api\Rest\Collection;
use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientException;
use frankmayer\ArangoDbPhpCore\Tests\Integration\DocumentIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use HttpResponse;


/**
 * Class DocumentTest
 * @package frankmayer\ArangoDbPhpCore
 */
class DocumentTest extends DocumentIntegrationTest
{
    /**
     * @var Client
     */
    public $client;


    /**
     * @throws ClientException
     */
    public function setUp()
    {
        $connector    = new Connector($this->client);
        $this->client = getClient($connector);

        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection';

        $collectionOptions    = ["waitForSync" => true];
        $collectionParameters = [];
        $options              = $collectionOptions;
        $this->client->bind(
            'Request',
            function () {
                $request = $this->client->getRequest();

                return $request;
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
        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection';

        $collectionOptions = ["waitForSync" => true];
        $options           = $collectionOptions;
        $this->client->bind(
            'Request',
            function () {
                $request = $this->client->getRequest();

                return $request;
            }
        );


        $request          = $this->client->make('Request');
        $request->options = $options;
        $request->path    = $this->client->fullDatabasePath . self::API_COLLECTION . '/' . $collectionName;
        $request->method  = self::METHOD_DELETE;

        /** @var HttpResponse $responseObject */
        $responseObject = $request->send();
        $body           = $responseObject->body;

        $this->assertArrayHasKey('code', json_decode($body, true));

        $decodedJsonBody = json_decode($body, true);

        $this->assertEquals(200, $decodedJsonBody['code']);

        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-NonExistingCollection';
        $collection     = new Collection($this->client);

        /** @var $responseObject HttpResponse */
        $collection->drop($collectionName);
    }
}
