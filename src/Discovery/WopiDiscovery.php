<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Discovery;

use Exception;
use loophp\psr17\Psr17Interface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

final class WopiDiscovery implements WopiDiscoveryInterface
{
    private string $baseUrl;

    private ClientInterface $client;

    private Psr17Interface $psr17;

    public function __construct(
        array $configuration,
        ClientInterface $client,
        Psr17Interface $psr17
    ) {
        $this->baseUrl = $configuration['server'];
        $this->client = $client;
        $this->psr17 = $psr17;
    }

    public function discoverExtension(string $extension): array
    {
        $extensions = [];

        foreach ($this->discover()->xpath('//net-zone/app') as $app) {
            foreach ($app->xpath(sprintf("action[@ext='%s']", $extension)) as $action) {
                $extensions[] = array_merge(
                    current($action->attributes()),
                    ['name' => (string) $app['name']],
                    ['favIconUrl' => (string) $app['favIconUrl']]
                );
            }
        }

        return $extensions;
    }

    public function getCapabilities(): array
    {
        $capabilities = $this->discover()->xpath("//net-zone/app[@name='Capabilities']");

        $url = (string) $capabilities[0]->action['urlsrc'];

        return json_decode((string) $this->request($url)->getBody(), true);
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
        return (string) $this->request(sprintf('%s/%s', $this->baseUrl, 'hosting/discovery'))->getBody();
    }

    private function request(string $url): ResponseInterface
    {
        $response = $this
            ->client
            ->sendRequest($this->psr17->createRequest('GET', $url));

        if (200 !== $response->getStatusCode()) {
            // TODO
            throw new Exception('Invalid status code');
        }

        return $response;
    }
}
