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
use SimpleXMLElement;

final class WopiDiscovery implements WopiDiscoveryInterface
{
    private string $baseUrl;

    private CacheItemPoolInterface $cache;

    private ClientInterface $client;

    private Psr17Interface $psr17;

    public function __construct(
        array $configuration,
        ClientInterface $client,
        Psr17Interface $psr17,
        CacheItemPoolInterface $cache
    ) {
        $this->baseUrl = $configuration['server'];
        $this->client = $client;
        $this->psr17 = $psr17;
        $this->cache = $cache;
    }

    public function discoverExtension(string $extension): array
    {
        $discovery = $this->discover();

        $extensions = [];

        foreach ($discovery->xpath('//net-zone/app') as $app) {
            $appName = (string) $app['name'];

            foreach ($app->xpath(sprintf("action[@ext='%s']", $extension)) as $action) {
                $extensions[] = array_merge(current($action->attributes()), ['name' => $appName]);
            }
        }

        return $extensions;
    }

    public function getCapabilities(): array
    {
        $discovery = $this->discover();

        $capabilities = $discovery->xpath("//net-zone/app[@name='Capabilities']");

        $url = (string) $capabilities[0]->action['urlsrc'];

        return json_decode($this->request($url), true);
    }

    public function refresh(): void
    {
        $this->discoverRaw();
    }

    private function discover(): SimpleXMLElement
    {
        return simplexml_load_string($this->discoverRaw());
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
