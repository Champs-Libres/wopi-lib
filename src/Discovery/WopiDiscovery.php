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

use const JSON_THROW_ON_ERROR;

final class WopiDiscovery implements WopiDiscoveryInterface
{
    private string $baseUrl;

    private ClientInterface $client;

    private Psr17Interface $psr17;

    /**
     * @param array<string, string> $configuration
     */
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

        /** @var false|SimpleXMLElement[]|null $apps */
        $apps = $this->discover()->xpath('//net-zone/app');

        if (false === $apps || null === $apps) {
            throw new Exception();
        }

        foreach ($apps as $app) {
            /** @var false|SimpleXMLElement[]|null $actions */
            $actions = $app->xpath(sprintf("action[@ext='%s']", $extension));

            if (false === $actions || null === $actions) {
                continue;
            }

            foreach ($actions as $action) {
                $extensions[] = array_merge(
                    (array) $action->attributes(),
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

        return json_decode(
            (string) $this->request((string) $capabilities[0]->action['urlsrc'])->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }

    private function discover(): SimpleXMLElement
    {
        $simpleXmlElement = simplexml_load_string(
            (string) $this->request(sprintf('%s/%s', $this->baseUrl, 'hosting/discovery'))->getBody()
        );

        if (false === $simpleXmlElement) {
            // TODO
            throw new Exception('Unable to parse XML.');
        }

        return $simpleXmlElement;
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
