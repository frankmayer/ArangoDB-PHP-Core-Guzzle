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
require __DIR__ . '/../../vendor/frankmayer/arangodb-php-core/tests/Integration/ExceptionTest.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\Tests\Integration\ExceptionIntegrationTest;
use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


class ExceptionTest extends \frankmayer\ArangoDbPhpCore\Tests\Integration\ExceptionTest
{
    use TestCaseTrait;

    /**
     * base URL part for cursor related operations
     */
    const URL_CURSOR = '/_api/cursor';

    const API_COLLECTION = '/_api/collection';


    /**
     * Override-able connector setup
     */
    protected function setupConnector()
    {
        $this->connector = new Connector();
    }


    public function testTimeoutException()
    {
        // Stop here and mark this test as incomplete.
        static::markTestIncomplete(
            'This test has not been implemented yet.'
        );

        //        $query = 'RETURN SLEEP(13)';
        //
        //        $statement = new Statement($this->connection, ["query" => $query]);
        //
        //        try {
        //            $statement->execute();
        //        } catch (ClientException $exception) {
        //            $this->assertEquals($exception->getCode(), 408);
        //            throw $exception;
        //        }
    }

}
