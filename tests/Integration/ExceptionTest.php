<?php
/**
 *
 * File: PromiseTest.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/ExceptionTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Tests\Integration\ExceptionIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


class ExceptionTest extends ExceptionIntegrationTest
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
}
