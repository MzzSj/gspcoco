<?php

namespace AmeliaHttp\Client\Common;

use AmeliaHttp\Client\Common\Exception\HttpClientNotFoundException;
use AmeliaHttp\Client\HttpAsyncClient;
use AmeliaHttp\Client\HttpClient;
use Psr\Http\Client\ClientInterface;
use AmeliaPsr\Http\Message\RequestInterface;

/**
 * A http client pool allows to send requests on a pool of different http client using a specific strategy (least used,
 * round robin, ...).
 */
abstract class HttpClientPool implements HttpAsyncClient, HttpClient
{
    /**
     * @var HttpClientPoolItem[]
     */
    protected $clientPool = [];

    /**
     * Add a client to the pool.
     *
     * @param HttpClient|HttpAsyncClient|HttpClientPoolItem|ClientInterface $client
     */
    public function addHttpClient($client)
    {
        if (!$client instanceof HttpClientPoolItem) {
            $client = new HttpClientPoolItem($client);
        }

        $this->clientPool[] = $client;
    }

    /**
     * Return an http client given a specific strategy.
     *
     * @throws HttpClientNotFoundException When no http client has been found into the pool
     *
     * @return HttpClientPoolItem Return a http client that can do both sync or async
     */
    abstract protected function chooseHttpClient();

    /**
     * {@inheritdoc}
     */
    public function sendAsyncRequest(RequestInterface $request)
    {
        return $this->chooseHttpClient()->sendAsyncRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request)
    {
        return $this->chooseHttpClient()->sendRequest($request);
    }
}
