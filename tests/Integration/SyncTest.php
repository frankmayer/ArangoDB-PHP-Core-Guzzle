<?php
/**
 *
 * File: PromiseTest.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleIntegrationTestCase.php';
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/SyncTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Tests\Integration\SyncIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


class SyncTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\SyncTest
{
    use TestCaseTrait;

    /**
     * base URL part for cursor related operations
     */
    const URL_CURSOR = '/_api/cursor';

    const API_COLLECTION = '/_api/collection';

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
}
