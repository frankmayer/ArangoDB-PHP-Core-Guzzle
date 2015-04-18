<?php
/**
 *
 * File: GuzzleUnitTest.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;


use GuzzleHttp\Client;

class GuzzleUnitTest extends ArangoDbPhpCoreGuzzleUnitTestCase
{
    public function testIfGuzzleClientInstantiable()
    {
        $client = new Client();
        $this->assertInstanceOf('GuzzleHttp\Client', $client);
    }
}