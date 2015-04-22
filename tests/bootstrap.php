<?php

/**
 * ArangoDB PHP Core Client Test-Suite: Test Bootstrap
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle;

require __DIR__ . '/../vendor/autoload.php';

use frankmayer\ArangoDbPhpCore\Client;
use frankmayer\ArangoDbPhpCore\ClientOptions;

//use frankmayer\ArangoDbPhpCore\Plugins\TracerPlugin;


function getClientOptions()
{

    //    $plugins = array('TracerPlugin' => new TracerPlugin());

    return [
        ClientOptions::OPTION_ENDPOINT             => 'http://db-link:8529',
        ClientOptions::OPTION_DEFAULT_DATABASE     => '_system',
        // endpoint to connect to
        /*
        ClientOptions::OPTION_AUTH_TYPE       => 'Basic',                 // use basic authorization
        ClientOptions::OPTION_AUTH_USER       => '',                      // user for basic authorization
        ClientOptions::OPTION_AUTH_PASSWD     => '',                      // password for basic authorization
        */
        // timeout in seconds
        ClientOptions::OPTION_TIMEOUT              => 5,
        // ClientOptions::OPTION_PLUGINS              => $plugins,
        ClientOptions::OPTION_REQUEST_CLASS        => 'frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpRequest',
        ClientOptions::OPTION_RESPONSE_CLASS       => 'frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpResponse',
        ClientOptions::OPTION_ARANGODB_API_VERSION => '10400',
        ClientOptions::OPTION_DNS_SERVER           => '127.0.0.1',
    ];
}


function getClient($connector)
{
    return new Client($connector, getClientOptions());
}