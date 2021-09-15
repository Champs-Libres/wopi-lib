<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Contract\Service\Clock\ClockInterface;
use ChampsLibres\WopiLib\Contract\Service\Discovery\DiscoveryInterface;
use ChampsLibres\WopiLib\Contract\Service\ProofValidatorInterface;
use ChampsLibres\WopiLib\Contract\Service\Utils\DotNetTimeConverterInterface;
use ChampsLibres\WopiLib\Contract\Service\WopiInterface;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;
use Psr\Http\Message\RequestInterface;
use Throwable;

use function strlen;

final class ProofValidator implements ProofValidatorInterface
{
    private ClockInterface $clock;

    private DiscoveryInterface $discovery;

    private DotNetTimeConverterInterface $dotNetTimeConverter;

    public function __construct(
        DiscoveryInterface $discovery,
        ClockInterface $clock,
        DotNetTimeConverterInterface $dotNetTimeConverter
    ) {
        $this->clock = $clock;
        $this->discovery = $discovery;
        $this->dotNetTimeConverter = $dotNetTimeConverter;
    }

    public function isValid(RequestInterface $request): bool
    {
        $timestamp = $request->getHeaderLine(WopiInterface::HEADER_TIMESTAMP);
        $date = $this->dotNetTimeConverter->toDatetime($timestamp);

        if (20 * 60 < ($this->clock->now()->getTimestamp() - $date->getTimestamp())) {
            return false;
        }

        $params = [];
        parse_str($request->getUri()->getQuery(), $params);
        $url = (string) $request->getUri();

        $expected = sprintf(
            '%s%s%s%s%s%s',
            pack('N', strlen($params['access_token'])),
            $params['access_token'],
            pack('N', strlen($url)),
            strtoupper($url),
            pack('N', 8),
            pack('J', $timestamp)
        );

        $key = $this->discovery->getPublicKey();
        $keyOld = $this->discovery->getPublicKeyOld();
        $xWopiProof = $request->getHeaderLine(WopiInterface::HEADER_PROOF);
        $xWopiProofOld = $request->getHeaderLine(WopiInterface::HEADER_PROOF_OLD);

        return $this->verify($expected, $xWopiProof, $key)
            || $this->verify($expected, $xWopiProofOld, $key)
            || $this->verify($expected, $xWopiProof, $keyOld);
    }

    /**
     * @param string $key The key in MSBLOB format
     */
    private function verify(string $expected, string $proof, string $key): bool
    {
        try {
            /** @var RSA $key */
            $key = PublicKeyLoader::loadPublicKey($key);
        } catch (Throwable $e) {
            return false;
        }

        return $key
            ->withHash('sha256')
            ->withPadding(RSA::SIGNATURE_RELAXED_PKCS1)
            ->verify($expected, (string) base64_decode($proof, true));
    }
}
