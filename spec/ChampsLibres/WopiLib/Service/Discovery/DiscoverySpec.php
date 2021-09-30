<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\ChampsLibres\WopiLib\Service\Discovery;

use ChampsLibres\WopiLib\Contract\Service\Configuration\ConfigurationInterface;
use ChampsLibres\WopiLib\Service\Discovery\Discovery;
use loophp\psr17\Psr17Interface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class DiscoverySpec extends ObjectBehavior
{
    public function it_is_able_to_discover_the_action(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17, RequestInterface $request, ResponseInterface $response)
    {
        $properties = [
            'server' => 'http://wopi-client:1234',
            'access_token_ttl' => 'access_token_ttl',
        ];

        $configuration->beConstructedWith($properties);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $response
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/discovery.xml'));

        // TODO: fix exception [err:Error("Cannot use object of type PhpSpec\Wrapper\Collaborator as array")] has been thrown.
        // TODO: submit a PR against phpspec/phpspec.
        // TODO: So we can use $configuration['server'] instead of $properties['server']

        $configuration
            ->offsetGet('server')
            ->willReturn('http://wopi-client:1234');

        $psr17
            ->createRequest('GET', sprintf('%s/hosting/discovery', $properties['server']))
            ->willReturn($request);

        $client
            ->sendRequest($request)
            ->willReturn($response);

        $this
            ->discoverAction('odt', 'edit')
            ->shouldReturn([
                'default' => 'true',
                'ext' => 'odt',
                'name' => 'edit',
                'urlsrc' => 'http://127.0.0.1:9980/loleaflet/d12ab86/loleaflet.html?',
                'app' => 'writer',
                'favIconUrl' => 'http://127.0.0.1:9980/loleaflet/d12ab86/images/x-office-document.svg',
            ]);

        $this
            ->discoverAction('odt', 'foo')
            ->shouldReturn(null);
    }

    public function it_is_able_to_discover_the_extension(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17, RequestInterface $request, ResponseInterface $response)
    {
        $properties = [
            'server' => 'http://wopi-client:1234',
            'access_token' => 'access_token',
            'access_token_ttl' => 'access_token_ttl',
        ];

        $configuration->beConstructedWith($properties);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $response
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/discovery.xml'));

        // TODO: fix exception [err:Error("Cannot use object of type PhpSpec\Wrapper\Collaborator as array")] has been thrown.
        // TODO: submit a PR against phpspec/phpspec.
        // TODO: So we can use $configuration['server'] instead of $properties['server']

        $configuration
            ->offsetGet('server')
            ->willReturn('http://wopi-client:1234');

        $psr17
            ->createRequest('GET', sprintf('%s/hosting/discovery', $properties['server']))
            ->willReturn($request);

        $client
            ->sendRequest($request)
            ->willReturn($response);

        $this
            ->discoverExtension('odt')
            ->shouldReturn([
                [
                    'default' => 'true',
                    'ext' => 'odt',
                    'name' => 'writer',
                    'urlsrc' => 'http://127.0.0.1:9980/loleaflet/d12ab86/loleaflet.html?',
                    'favIconUrl' => 'http://127.0.0.1:9980/loleaflet/d12ab86/images/x-office-document.svg',
                ],
            ]);
    }

    public function it_is_able_to_discover_the_mime_type(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17, RequestInterface $request, ResponseInterface $response)
    {
        $properties = [
            'server' => 'http://wopi-client:1234',
            'access_token' => 'access_token',
            'access_token_ttl' => 'access_token_ttl',
        ];

        $configuration->beConstructedWith($properties);

        $response
            ->getStatusCode()
            ->willReturn(200);

        $response
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/discovery.xml'));

        // TODO: fix exception [err:Error("Cannot use object of type PhpSpec\Wrapper\Collaborator as array")] has been thrown.
        // TODO: submit a PR against phpspec/phpspec.
        // TODO: So we can use $configuration['server'] instead of $properties['server']

        $configuration
            ->offsetGet('server')
            ->willReturn('http://wopi-client:1234');

        $psr17
            ->createRequest('GET', sprintf('%s/hosting/discovery', $properties['server']))
            ->willReturn($request);

        $client
            ->sendRequest($request)
            ->willReturn($response);

        $this
            ->discoverMimeType('application/vnd.oasis.opendocument.text')
            ->shouldReturn([
                [
                    'default' => 'true',
                    'ext' => '',
                    'name' => 'application/vnd.oasis.opendocument.text',
                    'urlsrc' => 'http://127.0.0.1:9980/loleaflet/d12ab86/loleaflet.html?',
                ],
            ]);
    }

    public function it_is_able_to_get_capabilities(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17, RequestInterface $request1, ResponseInterface $response1, RequestInterface $request2, ResponseInterface $response2)
    {
        $properties = [
            'server' => 'http://wopi-client:1234',
            'access_token' => 'access_token',
            'access_token_ttl' => 'access_token_ttl',
        ];

        $configuration->beConstructedWith($properties);

        $response1
            ->getStatusCode()
            ->willReturn(200);

        $response1
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/discovery.xml'));

        $response2
            ->getStatusCode()
            ->willReturn(200);

        $response2
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/capabilities.json'));

        // TODO: fix exception [err:Error("Cannot use object of type PhpSpec\Wrapper\Collaborator as array")] has been thrown.
        // TODO: submit a PR against phpspec/phpspec.
        // TODO: So we can use $configuration['server'] instead of $properties['server']

        $configuration
            ->offsetGet('server')
            ->willReturn('http://wopi-client:1234');

        $psr17
            ->createRequest('GET', sprintf('%s/hosting/discovery', $properties['server']))
            ->willReturn($request1);

        $psr17
            ->createRequest('GET', 'http://127.0.0.1:9980/hosting/capabilities')
            ->willReturn($request2);

        $client
            ->sendRequest($request1)
            ->willReturn($response1);

        $client
            ->sendRequest($request2)
            ->willReturn($response2);

        $this
            ->getCapabilities()
            ->shouldReturn([
                'convert-to' => [
                    'available' => true,
                ],
                'hasMobileSupport' => true,
                'hasProxyPrefix' => false,
                'hasTemplateSaveAs' => false,
                'hasTemplateSource' => true,
                'productName' => 'Collabora Online Development Edition',
                'productVersion' => '6.4.10',
                'productVersionHash' => 'd12ab86',
            ]);
    }

    public function it_is_able_to_retrieve_the_public_keys(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17, RequestInterface $request1, ResponseInterface $response1, RequestInterface $request2, ResponseInterface $response2)
    {
        $properties = [
            'server' => 'http://wopi-client:1234',
            'access_token' => 'access_token',
            'access_token_ttl' => 'access_token_ttl',
        ];

        $configuration->beConstructedWith($properties);

        $response1
            ->getStatusCode()
            ->willReturn(200);

        $response1
            ->getBody()
            ->willReturn(file_get_contents(__DIR__ . '/discovery.xml'));

        // TODO: fix exception [err:Error("Cannot use object of type PhpSpec\Wrapper\Collaborator as array")] has been thrown.
        // TODO: submit a PR against phpspec/phpspec.
        // TODO: So we can use $configuration['server'] instead of $properties['server']

        $configuration
            ->offsetGet('server')
            ->willReturn('http://wopi-client:1234');

        $psr17
            ->createRequest('GET', sprintf('%s/hosting/discovery', $properties['server']))
            ->willReturn($request1);

        $client
            ->sendRequest($request1)
            ->willReturn($response1);

        $this
            ->getPublicKey()
            ->shouldReturn(
                'value_BgIAAACkAABSU0ExAAgAAAEAAQDnoUzUmRfaRqZP65/QgY/6q6LJSMqYXNX/6Mi+SaGuzPRzMr0ZPlsNaarkHsaIrkhO11QPg9dUsW0pjJCw75y9OynHcc/7q/3hO9F/GLpC9NkW/eePWjZXj12JmSmKo5OkXHjmW2N3vIWGLzL3Qx47NtLyoWkhF55Qsq/z3y27epuzg1E2kYF2ki0rUjTqe2Kwx7evgj2ezTWHz+/2qI0C13KUyDLIfUvDkXmei+sXLIH/cHMA83itdL1hZLJfPS88Z3dUov5Ro9X5jaL1vFxpew0uEvqXD+Peu67UujmKbOOYK29HLI5brq4TkIr+LTAxZu3THqqLvM1wtJQkV++4'
            );

        $this
            ->getPublicKeyOld()
            ->shouldReturn(
                'oldvalue_BgIAAACkAABSU0ExAAgAAAEAAQDnoUzUmRfaRqZP65/QgY/6q6LJSMqYXNX/6Mi+SaGuzPRzMr0ZPlsNaarkHsaIrkhO11QPg9dUsW0pjJCw75y9OynHcc/7q/3hO9F/GLpC9NkW/eePWjZXj12JmSmKo5OkXHjmW2N3vIWGLzL3Qx47NtLyoWkhF55Qsq/z3y27epuzg1E2kYF2ki0rUjTqe2Kwx7evgj2ezTWHz+/2qI0C13KUyDLIfUvDkXmei+sXLIH/cHMA83itdL1hZLJfPS88Z3dUov5Ro9X5jaL1vFxpew0uEvqXD+Peu67UujmKbOOYK29HLI5brq4TkIr+LTAxZu3THqqLvM1wtJQkV++4'
            );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Discovery::class);
    }

    public function let(ConfigurationInterface $configuration, ClientInterface $client, Psr17Interface $psr17)
    {
        $this->beConstructedWith($configuration, $client, $psr17);
    }
}
