<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Test Bootstrap
 *
 * @package   frankmayer\ArangoDbPhpCoreGuzzle
 * @author    Frank Mayer
 * @copyright Copyright 2013-2017, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests;

require __DIR__ . '/../vendor/autoload.php';
//require __DIR__ . '/../autoload.php';
//$loader = @include __DIR__ . '/../vendor/autoload.php';
//if (!$loader) {
//    $loader = require __DIR__ . '/../../../../vendor/autoload.php';
//}
//$loader->addPsr4('frankmayer\\ArangoDbPhpCoreGuzzle\\', __DIR__);

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientOptions;
use frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpRequest;
use frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpResponse;

//use frankmayer\ArangoDbPhpCore\Plugins\TracerPlugin;


function getClientOptions()
{

    //    $plugins = array('TracerPlugin' => new TracerPlugin());

    return [
        ClientOptions::OPTION_ENDPOINT             => 'http://db-link:8529',
        ClientOptions::OPTION_DEFAULT_DATABASE     => '_system',
        ClientOptions::OPTION_DATABASE_PATH_PREFIX => '/_db/',
        // endpoint to connect to
        ClientOptions::OPTION_AUTH_TYPE       => 'Basic',                 // use basic authorization
        ClientOptions::OPTION_AUTH_USER       => 'root',                      // user for basic authorization
        ClientOptions::OPTION_AUTH_PASSWD     => '',                      // password for basic authorization
        // timeout in seconds
        ClientOptions::OPTION_TIMEOUT              => 5,
        // ClientOptions::OPTION_PLUGINS              => $plugins,
        ClientOptions::OPTION_REQUEST_CLASS        => HttpRequest::class,
        ClientOptions::OPTION_RESPONSE_CLASS       => HttpResponse::class,
        ClientOptions::OPTION_CLIENT_ASYNC_PROCESSING       => false,
    ];
}


/**
 * @param       $connector
 * @param array $overrides
 *
 * @return Client
 */
function getClient($connector, array $overrides = [])
{
    $clientOptions = array_merge(getClientOptions(), $overrides);
    return new Client($connector, $clientOptions);
}