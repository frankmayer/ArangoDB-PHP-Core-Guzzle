<?php

/**
 * ArangoDB PHP client testsuite
 * File: CollectionUnitTest.php
 *
 * @package frankmayer\ArangoDbPhpNg
 * @author  Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once('ArangoDbPhpCoreGuzzleUnitTestCase.php');

use frankmayer\ArangoDbPhpCore\Client;


/**
 * Class CoreObjectTest
 *
 *
 * @property Client $client
 * @package frankmayer\ArangoDbPhpNg
 */
class CollectionUnitTest extends ArangoDbPhpCoreGuzzleUnitTestCase
{
    const API_COLLECTION = '/_api/collection';

    const METHOD_GET     = 'GET';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_PATCH   = 'PATCH';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_HEAD    = 'HEAD';
    const METHOD_OPTIONS = 'OPTIONS';

    /**
     * @var Client
     */
    public $client;

    public function testCollection()
    {
    }


    //    /**
    //     * Test if we can get the server version
    //     */
    //    public function testCreateCollection()
    //    {
    //        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection';
    //
    //        $collectionOptions    = ["waitForSync" => true];
    //        $collectionParameters = [];
    //        $options              = $collectionOptions;
    //        Client::bind(
    //            'Request',
    //            function () {
    //                $request         = new $this->client->requestClass();
    //                $request->client = $this->client;
    //
    //                return $request;
    //            }
    //        );
    //
    //        // And here's how one gets an HttpRequest object through the IOC.
    //        // Note that the type-name 'httpRequest' is the name we bound our HttpRequest class creation-closure to. (see above)
    //        $request          = Client::make('Request');
    //        $request->options = $options;
    //        $request->body    = ['name' => $collectionName];
    //
    //        $request->body = self::array_merge_recursive_distinct($request->body, $collectionParameters);
    //        $request->body = json_encode($request->body);
    //
    //        $request->path   = $request->getDatabasePath() . self::API_COLLECTION;
    //        $request->method = self::METHOD_POST;
    //
    //        $responseObject = $request->request();
    //
    //        //        return $responseObject;
    //        $body = $responseObject->body;
    //
    //        $this->assertArrayHasKey('code', json_decode($body, true));
    //        $decodedJsonBody = json_decode($body, true);
    //        $this->assertEquals(200, $decodedJsonBody['code']);
    //        $this->assertEquals($collectionName, $decodedJsonBody['name']);
    //    }


    //    /**
    //     * Test if we can get the server version
    //     */
    //    public function testDeleteCollection()
    //    {
    //
    //        $collectionName = 'ArangoDB-PHP-Core-CollectionTestSuite-Collection';
    //
    //        $collectionOptions = ["waitForSync" => true];
    //        $options           = $collectionOptions;
    //        Client::bind(
    //            'Request',
    //            function () {
    //                $request         = new $this->client->requestClass();
    //                $request->client = $this->client;
    //
    //                return $request;
    //            }
    //        );
    //
    //        $request = Client::make('Request');
    //
    //        $request->options = $options;
    //        $request->path    = $request->getDatabasePath() . self::API_COLLECTION . '/' . $collectionName;
    //        $request->method  = self::METHOD_DELETE;
    //
    //        $responseObject = $request->request();
    //        $body           = $responseObject->body;
    //
    //        $this->assertArrayHasKey('code', json_decode($body, true));
    //        $decodedJsonBody = json_decode($body, true);
    //        $this->assertEquals(200, $decodedJsonBody['code']);
    //    }


    //    /**
    //     *
    //     */
    //    public function testCreateAndDeleteCollection2()
    //    {
    //        //        $db                  = new Database($this->client->connection);
    //        //        $collection          = new Collection($db);
    //        //        $collection->payload = json_encode(['name' => 'testfrank01']);
    //        //        $collection->name    = 'testfrank01';
    //        //        $name                = 'testfrank01';
    //        //        $response            = Collection::create($db, $collection);
    //        //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\HttpResponse', $response);
    //        //
    //        //        $response = Collection::delete($db, $name);
    //        //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\HttpResponse', $response);
    //    }

    //    /**
    //     *
    //     */
    //    public function testCreateAndDeleteCollection()
    //    {
    //
    //        $db = new Database($this->client->connection);
    //
    //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\Database', $db);
    //
    //        $response = Collection::create($db, json_encode(['name' => 'testfrank01']));
    //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\HttpResponse', $response);
    //
    //        $response = Collection::delete($db, 'testfrank01');
    //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\HttpResponse', $response);
    //    }
    //
    //    /**
    //     *
    //     */
    //    public function testCreateAndDeleteCollectionWithArrayMutatorCallback()
    //    {
    //
    //        $db = new Database($this->client->connection);
    //        # $collection = $this->client->getClass('Collection');
    //
    //        $options['responseMutator'] = function ($response) {
    //            /** @var $response HttpResponse */
    //            $response = $response->getJson(true);
    //
    //            return $response;
    //        };
    //
    //        $response = Collection::create($db, json_encode(['name' => 'testfrank01']), $options);
    //        $this->assertTrue(is_array($response));
    //
    //        $response = Collection::delete($db, 'testfrank01', $options);
    //        $this->assertTrue(is_array($response));
    //    }
    //
    //
    //    /**
    //     *
    //     */
    //    public function testCreateAndDeleteCollectionWithObjectMutatorCallback()
    //    {
    //
    //        $db = new Database($this->client->connection);
    //
    //        $options['responseMutator'] = function ($response) {
    //            /** @var $response HttpResponse */
    //            $response = $response->getJson(false);
    //
    //            return $response;
    //        };
    //
    //        $response = Collection::create($db, json_encode(['name' => 'testfrank01']), $options);
    //        $this->assertTrue(is_Object($response));
    //
    //        $response = Collection::delete($db, 'testfrank01', $options);
    //        $this->assertTrue(is_Object($response));
    //    }
    //
    //
    //    /**
    //     *
    //     */
    //    public function testCreateAndDeleteCollectionWithWrongAttributes()
    //    {
    //        // Try to create a collection with empty name attribute. Should raise Exception with code 400
    //        $db = new Database($this->client->connection);
    //
    //        try {
    //
    //            Collection::create($db, json_encode(['name' => '']));
    //        } catch (ServerException $e) {
    //            $this->assertTrue($e->getCode() == 400);
    //        }
    //
    //        // Try to delete a nonexistent collection. Should return an HttpResponse object
    //        $response = Collection::delete($db, 'testfrank01');
    //        $this->assertInstanceOf('frankmayer\ArangoDbPhpNg\HttpResponse', $response);
    //        $this->assertTrue($response->getHttpCode() == 404);
    //    }


    //    public function tearDown()
    //    {
    //        //        try {
    //        //        } catch (\Exception $e) {
    //        //            // don't bother us, if it's already deleted.
    //        //        }
    //        //
    //        //        unset($this->connection);
    //    }
}
