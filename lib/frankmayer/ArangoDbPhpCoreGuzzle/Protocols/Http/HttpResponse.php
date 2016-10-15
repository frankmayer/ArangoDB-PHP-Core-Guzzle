<?php

/**
 * ArangoDB PHP Core Client: HTTP Response
 *
 * @package   frankmayer\ArangoDbPhpCore
 * @author    Frank Mayer
 * @copyright Copyright 2013, FRANKMAYER.NET, Athens, Greece
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Protocols\Http;

use frankmayer\ArangoDbPhpCore\Protocols\Http\AbstractHttpRequest;
use frankmayer\ArangoDbPhpCore\ServerException;
use Future;
use GuzzleHttp\Psr7\Response;


/**
 * Http-Response object holding the raw and objectified Response data.
 *
 * @package frankmayer\ArangoDbPhpCore
 */
class HttpResponse extends \frankmayer\ArangoDbPhpCore\Protocols\Http\HttpResponse
{
    /**
     * @var \GuzzleHttp\Psr7\Request
     */
    public $requestHandler;

	/**
	 * @param HttpRequest $request
	 *
	 * @return static
	 * @throws \frankmayer\ArangoDbPhpCore\ServerException
	 */
    public function build($request)
    {
        if ($request instanceof AbstractHttpRequest) {
            $response      = $request->response;
            $this->request = $request;

            if ($request->batch === true) {
                $boundary    = $request->batchBoundary;
                $this->batch = $this->deconstructBatchResponseBody($response, $boundary);
            }
        } else {
            $response = $request;
        }

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
     * @param \GuzzleHttp\Psr7\Response $response
     *
     * @throws ServerException
     */
    private function getGuzzleResponseData($response)
    {
        if (!is_a($response, '\GuzzleHttp\Psr7\Response')) {
            $this->splitResponseToHeadersArrayAndBody($response);
            $response   = new Response($this->status, $this->headers, null, []);
            $this->body = (string) $this->body;
            //            $this->status = (int) explode(' ', $this->status)[1];
            $statusLineArray = explode(' ', trim($this->headers['status'][0]));

            $this->status = (int) $statusLineArray[1];
        } else {
            $this->status             = $response->getStatusCode();
            $this->body               = (string) $response->getBody();
            $response->requestHandler = $this->request->requestHandler;
        }

        $this->headers = $response->getHeaders();

        if ($this->verboseExtractStatusLine === true) {
            $this->getVerboseStatusLine($response);
        }

        if (in_array((int) $this->status, $this->enabledHttpServerExceptions, true)) {
            $this->getVerboseStatusLine($response);
            throw new ServerException($this->statusPhrase, $this->status);
        }
    }


    /**
     * @param HttpResponse $response
     */
    private function getVerboseStatusLine($response)
    {
        $this->protocol = strtoupper($response->requestHandler->getScheme()) . '/' . $response->requestHandler->getProtocolVersion();
        $this->statusPhrase = $response->getReasonPhrase();
    }
}