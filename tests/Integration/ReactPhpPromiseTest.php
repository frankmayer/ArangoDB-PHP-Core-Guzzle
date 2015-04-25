<?php
/**
 *
 * File: PromiseTest.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once('ArangoDbPhpCoreGuzzleIntegrationTestCase.php');

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;
use GuzzleHttp\Message\FutureResponse;
use React\EventLoop\Factory;
use WyriHaximus\React\RingPHP\HttpClientAdapter;


class ReactPhpPromiseTest extends ArangoDbPhpCoreGuzzleIntegrationTestCase
{

    /**
     * base URL part for cursor related operations
     */
    const URL_CURSOR = '/_api/cursor';

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


    public function setUp()
    {
        $connector    = new Connector();
        $this->client = getClient($connector);
    }


    /**
     * Test if we can get the server version
     */
    public function testPromise()
    {
        $collectionParameters = [];

        $loop = Factory::create();

        $dnsResolverFactory = new \React\Dns\Resolver\Factory();
        $dnsResolver        = $dnsResolverFactory->createCached('127.0.0.1', $loop);

        $handler = new HttpClientAdapter($loop, null, $dnsResolver);

        $this->client->bind(
            'Request',
            function () {
                $request         = new $this->client->requestClass($this);
                $request->client = $this->client;

                return $request;
            }
        );


        $query = 'RETURN SLEEP(1)';

        $statement = ["query" => $query];

        // And here's how one gets an HttpRequest object through the IOC.
        // Note that the type-name 'httpRequest' is the name we bound our HttpRequest class creation-closure to. (see above)
        $request = $this->client->make('Request');

        $request->body             = $statement;
        $request->connectorOptions = ['future' => true];

        $request->body    = self::array_merge_recursive_distinct($request->body, $collectionParameters);
        $request->body    = json_encode($request->body);
        $request->handler = $handler;

        $request->path   = $this->client->fullDatabasePath . self::URL_CURSOR;
        $request->method = self::METHOD_POST;

        $responseObject = $request->send();
        $this->assertInstanceOf('\GuzzleHttp\Message\FutureResponse', $request->response);

        /**
         * @var \React\Promise\Promise $response
         */
        $response = $request->response;
        if ($response instanceof FutureResponse) {
            return $response->then(function () use ($responseObject) {
                $body = $responseObject->body;

                $this->assertArrayHasKey('code', json_decode($body, true));
                $decodedJsonBody = json_decode($body, true);
                $this->assertEquals(201, $decodedJsonBody['code']);
            });
        } else {
            $body = $responseObject->body;

            $this->assertArrayHasKey('code', json_decode($body, true));
            $decodedJsonBody = json_decode($body, true);
            $this->assertEquals(201, $decodedJsonBody['code']);
        }
        $loop->run();
    }


    /**
     * Test if we can get the server version
     */
    public function testMultiplePromise()
    {
        $collectionParameters = [];
        $this->client->bind(
            'Request',
            function () {
                $request         = new $this->client->requestClass($this);
                $request->client = $this->client;

                return $request;
            }
        );
        $query = 'RETURN SLEEP(1)';

        $statement = ["query" => $query];

        $loop = Factory::create();

        $dnsResolverFactory = new \React\Dns\Resolver\Factory();
        $dnsResolver        = $dnsResolverFactory->createCached('127.0.0.1', $loop);

        $handler = new HttpClientAdapter($loop, null, $dnsResolver);

        $i = 0;


        $request = $this->client->make('Request');
        //        $request->options          = $options;
        $request->body             = $statement;
        $request->handler          = $handler;
        $request->connectorOptions = ['future' => true];

        $request->body = self::array_merge_recursive_distinct($request->body, $collectionParameters);
        $request->body = json_encode($request->body);

        $request->path   = $this->client->fullDatabasePath . self::URL_CURSOR;
        $request->method = self::METHOD_POST;
        $requests[$i]    = $request;

        for ($i = 1; $i <= 4; $i++) {

            /**
             * @var FutureResponse $promise
             */
            $promise = $request->send();

            $promise->then(function ($responseObject) {
                $body = $responseObject->body;
                echo "Output: $body, " . (new \DateTime())->format('Y-m-d H:i:s') . "\r\n";
                $this->assertEquals(201, $responseObject->status);
            },
                function ($error) {
                    var_dump($error);
                });
        }


        $loop->run();
    }
}