<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Discovery\WopiDiscoveryInterface;
use ChampsLibres\WopiLib\Service\Contract\WopiProofValidatorInterface;
use phpseclib3\Crypt\PublicKeyLoader;
use Psr\Http\Message\RequestInterface;
use Throwable;

use function strlen;
use const OPENSSL_ALGO_SHA256;

final class WopiProofValidator implements WopiProofValidatorInterface
{
    private WopiDiscoveryInterface $wopiDiscovery;

    public function __construct(WopiDiscoveryInterface $wopiDiscovery)
    {
        $this->wopiDiscovery = $wopiDiscovery;
    }

    public function __constructX(string $accessToken, string $url, string $timestamp)
    {
        $this->expected = sprintf(
            '%s%s%s%s%s%s',
            pack('N', strlen($accessToken)),
            $accessToken,
            pack('N', strlen($url)),
            strtoupper($url),
            pack('N', 8),
            pack('J', $timestamp)
        );
    }

    public function isValid(RequestInterface $request): bool
    {
        $xWopiProof = $request->getHeaderLine('X-WOPI-Proof');
        $xWopiProofOld = $request->getHeaderLine('X-WOPI-ProofOld');
        $timestamp = $request->getHeaderLine('X-WOPI-Timestamp');

        $key = $this->wopiDiscovery->getPublicKey();
        $keyOld = $this->wopiDiscovery->getPublicKeyOld();

        $url = (string) $request->getUri();
        $params = [];
        parse_str($request->getUri()->getQuery(), $params);

        $expected = sprintf(
            '%s%s%s%s%s%s',
            pack('N', strlen($params['access_token'])),
            $params['access_token'],
            pack('N', strlen($url)),
            strtoupper($url),
            pack('N', 8),
            pack('J', $timestamp)
        );

        return $this->verify($expected, $xWopiProof, $key) || $this->verify($expected, $xWopiProofOld, $key) || $this->verify($expected, $xWopiProof, $keyOld);
    }

    /**
     * @param string $key The key in MSBLOB format
     */
    private function verify(string $expected, string $proof, string $key): bool
    {
        try {
            $key = PublicKeyLoader::loadPublicKey($key);
        } catch (Throwable $e) {
            return false;
        }

        return 1 === openssl_verify(
            $expected,
            base64_decode($proof, true),
            $key,
            OPENSSL_ALGO_SHA256
        );
    }
}
