<?php

/**
 * ArangoDB PHP client testsuite
 * File: CollectionUnitTest.php
 *
 * @package frankmayer\ArangoDbPhpCore
 * @author  Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require_once __DIR__ . '/ArangoDbPhpCoreGuzzleUnitTestCase.php';

use frankmayer\ArangoDbPhpCore\Client;


/**
 * Class CoreObjectTest
 *
 *
 * @property Client $client
 * @package frankmayer\ArangoDbPhpCoreGuzzle
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

    public function testFake()
    {
        static::markTestSkipped(
            'This test has not been implemented yet. Check if this is needed here... anyways'
        );
    }


}
