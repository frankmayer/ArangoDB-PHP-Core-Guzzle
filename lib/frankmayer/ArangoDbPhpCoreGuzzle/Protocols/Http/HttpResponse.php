<?php

/**
 * ArangoDB PHP Core Client: HTTP Response
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http;

use frankmayer\ArangoDbPhpCore\Protocols\Http\HttpResponseInterface;
use frankmayer\ArangoDbPhpCore\ServerException;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\Response;


/**
 * Http-Response object holding the raw and objectified Response data.
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class HttpResponse extends \frankmayer\ArangoDbPhpCore\Protocols\Http\HttpResponse implements HttpResponseInterface
{
    /**
     * @var \GuzzleHttp\Message\Request
     */
    public $requestHandler;

    /**
     * @param HttpRequest $request
     *
     * @return static
     */
    public function build($request)
    {
        $response      = $request->response;
        $this->request = $request;
        if ($response instanceof FutureResponse) {
            return $response->then(function ($response) {
                $this->getGuzzleResponseData($response);

                return $this;
            });
        } else {
            $this->getGuzzleResponseData($response);
        }

        return $this;
    }


    /**
     * @param $response HttpResponse
     *
     * @throws ServerException
     */
    private function getGuzzleResponseData($response)
    {
        if (!is_a($response, 'GuzzleHttp\Message\Response')) {
            $this->splitResponseToHeadersArrayAndBody($response);
            $response     = new Response($this->status, $this->headers, null, []);
            $this->body   = (string) $this->body;
            $this->status = (int) explode(' ', $this->status)[1];
        } else {
            $this->status             = $response->getStatusCode();
            $this->body               = (string) $response->getBody();
            $response->requestHandler = $this->request->requestHandler;
        }

        $this->headers = $response->getHeaders();

        if ($this->verboseExtractStatusLine === true) {
            $this->getVerboseStatusLine($response);
        }

        if (in_array(intval($this->status), $this->enabledHttpServerExceptions)) {
            $this->getVerboseStatusLine($response);
            throw new ServerException($this->statusPhrase, $this->status);
        }
    }


    /**
     * @param HttpResponse $response
     */
    private function getVerboseStatusLine($response)
    {
        $this->protocol = strtoupper($response->requestHandler->getScheme()) . "/" . $response->requestHandler->getProtocolVersion();;
        $this->statusPhrase = $response->getReasonPhrase();
    }
}