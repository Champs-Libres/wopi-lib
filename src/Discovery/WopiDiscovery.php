<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Discovery;

use loophp\psr17\Psr17Interface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

final class HttpDiscovery implements WopiDiscoveryInterface
{
    private string $baseUrl;

    private CacheItemPoolInterface $cache;

    private ClientInterface $client;

    private Psr17Interface $psr17;

    public function __construct(array $configuration, ClientInterface $client, Psr17Interface $psr17, CacheItemPoolInterface $cache)
    {
        $this->baseUrl = $configuration['server'];
        $this->client = $client;
        $this->psr17 = $psr17;
        $this->cache = $cache;
    }

    public function discover(): array
    {
        return json_decode(json_encode(simplexml_load_string($this->discoverRaw())), true);
    }

    public function getCapabilities(): array
    {
        $xml = simplexml_load_string($this->discoverRaw());

        foreach ($xml->{'net-zone'}->app as $app) {
            if ('getinfo' !== (string) $app->action['name']) {
                continue;
            }

            $url = (string) $app->action['urlsrc'];
        }

        return json_decode($this->request($url), true);
    }

    private function discoverRaw(): string
    {
        return $this->request(sprintf('%s/%s', $this->baseUrl, 'hosting/discovery'));
    }

    private function request(string $url): string
    {
        $item = $this->cache->getItem(sha1($url));

        if ($item->isHit()) {
            return $item->get();
        }

        $data = (string) $this
            ->client
            ->sendRequest($this->psr17->createRequest('GET', $url))
            ->getBody();

        $item->set($data);
        $this->cache->save($item);

        return $data;
    }
}
