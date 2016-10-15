<?php

/**
 * ArangoDB PHP Core Client: Curl HTTP Connector
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Connectors;


use frankmayer\ArangoDbPhpCore\ClientOptions;
use frankmayer\ArangoDbPhpCore\Connectors\AbstractHttpConnector;
use frankmayer\ArangoDbPhpCore\Protocols\Http\AbstractHttpRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;


/**
 * This connector acts as a wrapper to PHP's curl class.
 * It must be injected into the client object upon the client's creation.
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class Connector extends AbstractHttpConnector
{
    /**
     * @param AbstractHttpRequest $request
     *
     * @return mixed
     * @throws \frankmayer\ArangoDbPhpCore\ClientException
     * @throws \frankmayer\ArangoDbPhpCore\ServerException
     */
    public function request(AbstractHttpRequest $request)
    {
        $this->client->responseClass = 'frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http\HttpResponse';

        $headers          = [];
        $clientParameters = [];

        if (property_exists($request, 'handler')) {
            $clientParameters = ['handler' => $request->handler];
        }
        $client = new Client($clientParameters);
        $body   = $request->body;

        $request->headers['Content-Length'] = strlen($body);

        foreach ($request->headers as $headerKey => $headerVal) {
            $headers[] = $headerKey . ': ' . $headerVal;
        }

        //todo implement logging if activated

        $clientOptions = $request->client->clientOptions;
        $config        = [];

        // Ignoring this, as the server needs to have authentication enabled in order to run through this.
        //         @codeCoverageIgnoreStart
        if (isset ($clientOptions[ClientOptions::OPTION_AUTH_TYPE])) {
            if (strtolower($clientOptions[ClientOptions::OPTION_AUTH_TYPE]) === 'basic') {
                $config = [
                    'config' => [
                        'curl' => [
                            CURLOPT_HTTPAUTH => CURLAUTH_NTLM,
                            CURLOPT_USERPWD  => 'username:password',
                        ],
                    ],
                ];
            }
        }
        //         @codeCoverageIgnoreEnd

        $connectorOptions = ['body' => $request->body, 'headers' => $request->headers];

        if (count($config) > 0) {
            $connectorOptions = array_merge($connectorOptions, $config);
        }

        $connectorOptions = array_merge($connectorOptions, $request->connectorOptions, ['exceptions' => false]);

        $guzzleRequest           = $client->createRequest($request->method, $request->address, $connectorOptions);
        $request->requestHandler = $guzzleRequest;
        try {
            $response = $client->send($guzzleRequest);
        } catch (ClientException $e) {
            throw new \frankmayer\ArangoDbPhpCore\ClientException($e->getMessage(), $e->getCode(), $e);
        } catch (ServerException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                throw new \frankmayer\ArangoDbPhpCore\ServerException($e->getMessage(), $e->getCode(), $e);
            }
        } catch (RequestException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                throw new \frankmayer\ArangoDbPhpCore\ClientException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $response;
    }
}