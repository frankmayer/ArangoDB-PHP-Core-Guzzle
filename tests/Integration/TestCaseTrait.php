<?php
/**
 *
 * File: ArangoDbPhpCoreTestCase.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Integration;

use frankmayer\ArangoDbPhpCoreGuzzle\Connectors\Connector;


/**
 * Class ArangoDbPhpCoreTestCase
 *
 * @package frankmayer\ArangoDbPhpCoreGuzzle
 */
trait TestCaseTrait
{
    /**
     *
     */
    public $TESTNAMES_PREFIX = 'ArangoDB-PHP-Core-Guzzle-';
    /**
     *
     */
    public $TESTS_NAMESPACE = '\\frankmayer\\ArangoDbPhpCoreGuzzle\\Tests\\';
}