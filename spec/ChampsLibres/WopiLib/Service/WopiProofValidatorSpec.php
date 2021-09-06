<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Discovery\WopiDiscoveryInterface;
use ChampsLibres\WopiLib\Service\WopiProofValidator;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class WopiProofValidatorSpec extends ObjectBehavior
{
    public function it_can_verify_a_request(RequestInterface $request, UriInterface $uri)
    {
        $request
            ->getHeaderLine('X-WOPI-Proof')
            ->willReturn('dcDQv3isZbtSCYmB5rjAzNmUtXRcMyn3l7hfXPc+W4i5BgGNSYnJag9YQ+N6VGTGJW3Ss7LT3OPE8Yev+FEie1zn7d8yYOxHMqvfzcAsQQ5WMKixfxHAZqm06c3Hbj0T0tROG21EKzmP7vR1Y6Lw3up2zkQTozGuYGQcESMRQf/NuY5oGu8NAlKQprEnS5ugfT4FKF5297su5/e0VxhYXcbax3vNsNNmiHNAtxxxCiEM9/WSKjwF+8wVmjpjx1ndNrzNpLUbSEezrbMs7vXMcSmnecu7aTfGYgo5CyGyEyOJccg+HaPa+Os1gM5dRXEeX96wPKvXOsZAo4aX6Oj0ag==');

        $request
            ->getHeaderLine('X-WOPI-ProofOld')
            ->willReturn('dcDQv3isZbtSCYmB5rjAzNmUtXRcMyn3l7hfXPc+W4i5BgGNSYnJag9YQ+N6VGTGJW3Ss7LT3OPE8Yev+FEie1zn7d8yYOxHMqvfzcAsQQ5WMKixfxHAZqm06c3Hbj0T0tROG21EKzmP7vR1Y6Lw3up2zkQTozGuYGQcESMRQf/NuY5oGu8NAlKQprEnS5ugfT4FKF5297su5/e0VxhYXcbax3vNsNNmiHNAtxxxCiEM9/WSKjwF+8wVmjpjx1ndNrzNpLUbSEezrbMs7vXMcSmnecu7aTfGYgo5CyGyEyOJccg+HaPa+Os1gM5dRXEeX96wPKvXOsZAo4aX6Oj0ag==');

        $request
            ->getHeaderLine('X-WOPI-Timestamp')
            ->willReturn('637664702964021765');

        $uri
            ->getQuery()
            ->willReturn('access_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzA4NzM0OTUsImV4cCI6MTYzMDg3NzA5NSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sImZpbGVVdWlkIjoiNDZmZmI3NmMtZWJjYi00ZjVjLWJjNGMtNWVjZTFlMDY0ZjNmIiwidXNlcm5hbWUiOiJhZG1pbiJ9.SR-kFrWH6CBSrYXIaeO7-C8p4a1X4TmLwVGLcIBR1nKhTWCqKJ2g7K3mOmCI45ReeEnYPsuivUMIxMAqGI3ZbpcCj0PRpJrfbPh0mAKkyiE9Muf_NDbBd_mHvHGyBMSckOzIu2Z8t2uRSxc0rDkiWDLAGTKnVg1Z4k3o6ZBRg4VZJcKy8FdmslTJwl0eVhk2KdfXTxsP31EOkgLTRVBup8CW1GauD9xs4PEcXp03rgRSRLWzqeo9zUhbBq9IN9iqYOJs1GmtrSr2zkfr-cqYrl4hbELfnTGFA16_xjPLqbQbxwoZvLJOGe4CBeYfNo7Tjz50Tg9M2hCV1YW0mUmz9Q&access_token_ttl=0');

        $uri
            ->__toString()
            ->willReturn('http://web:8080/wopi/files/46ffb76c-ebcb-4f5c-bc4c-5ece1e064f3f?access_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzA4NzM0OTUsImV4cCI6MTYzMDg3NzA5NSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sImZpbGVVdWlkIjoiNDZmZmI3NmMtZWJjYi00ZjVjLWJjNGMtNWVjZTFlMDY0ZjNmIiwidXNlcm5hbWUiOiJhZG1pbiJ9.SR-kFrWH6CBSrYXIaeO7-C8p4a1X4TmLwVGLcIBR1nKhTWCqKJ2g7K3mOmCI45ReeEnYPsuivUMIxMAqGI3ZbpcCj0PRpJrfbPh0mAKkyiE9Muf_NDbBd_mHvHGyBMSckOzIu2Z8t2uRSxc0rDkiWDLAGTKnVg1Z4k3o6ZBRg4VZJcKy8FdmslTJwl0eVhk2KdfXTxsP31EOkgLTRVBup8CW1GauD9xs4PEcXp03rgRSRLWzqeo9zUhbBq9IN9iqYOJs1GmtrSr2zkfr-cqYrl4hbELfnTGFA16_xjPLqbQbxwoZvLJOGe4CBeYfNo7Tjz50Tg9M2hCV1YW0mUmz9Q&access_token_ttl=0');

        $request
            ->getUri()
            ->willReturn($uri);

        $this
            ->isValid($request)
            ->shouldReturn(true);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(WopiProofValidator::class);
    }

    public function let(WopiDiscoveryInterface $wopiDiscovery)
    {
        $wopiDiscovery
            ->getPublicKey()
            ->willReturn('BgIAAACkAABSU0ExAAgAAAEAAQCZf5Q9uM8yf7qPrZZr+Ou3i0e/0G2n8/o7ahMvHA/Xn1cvcQgoMdWKk/EJElrcG5aK9qWXqBsSE3mj49eq+D8uoUJKnsTnrC1FksmIp1YLqLdD7MDq1BvKHyBM5Nc1v/St7MfrRKD5f2UUzosbiVf8cZxdsTjqFYm3xTE2fu+gH/ug3IwbtqL3Uf0UcTyBC/RpCcX7GCEslqjr3TCuV0v8TqyQ6dKQWgEsTkymCTn2qWMLoBoNUpPKAXU5bl9to/VxMW7IVr0+6RRTX+rIqKcVaR4GNHpXHIwzjNwLMjZgfavYFqTZ3ul0j5evL4nrP3jTHVY320XhkU857eBjWWPN');

        $wopiDiscovery
            ->getPublicKeyOld()
            ->willReturn('BgIAAACkAABSU0ExAAgAAAEAAQCZf5Q9uM8yf7qPrZZr+Ou3i0e/0G2n8/o7ahMvHA/Xn1cvcQgoMdWKk/EJElrcG5aK9qWXqBsSE3mj49eq+D8uoUJKnsTnrC1FksmIp1YLqLdD7MDq1BvKHyBM5Nc1v/St7MfrRKD5f2UUzosbiVf8cZxdsTjqFYm3xTE2fu+gH/ug3IwbtqL3Uf0UcTyBC/RpCcX7GCEslqjr3TCuV0v8TqyQ6dKQWgEsTkymCTn2qWMLoBoNUpPKAXU5bl9to/VxMW7IVr0+6RRTX+rIqKcVaR4GNHpXHIwzjNwLMjZgfavYFqTZ3ul0j5evL4nrP3jTHVY320XhkU857eBjWWPN');

        $this->beConstructedWith($wopiDiscovery);
    }
}
