<?php

namespace AmeliaHttp\Client\Common\HttpClientPool;

use AmeliaHttp\Client\Common\Exception\HttpClientNotFoundException;
use AmeliaHttp\Client\Common\HttpClientPool;
use AmeliaHttp\Client\Common\HttpClientPoolItem;

/**
 * RoundRobinClientPool will choose the next client in the pool.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class RandomClientPool extends HttpClientPool
{
    /**
     * {@inheritdoc}
     */
    protected function chooseHttpClient()
    {
        $clientPool = array_filter($this->clientPool, function (HttpClientPoolItem $clientPoolItem) {
            return !$clientPoolItem->isDisabled();
        });

        if (0 === count($clientPool)) {
            throw new HttpClientNotFoundException('Cannot choose a http client as there is no one present in the pool');
        }

        return $clientPool[array_rand($clientPool)];
    }
}
