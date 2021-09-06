<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Discovery\WopiDiscoveryInterface;
use ChampsLibres\WopiLib\Service\Contract\ClockInterface;
use ChampsLibres\WopiLib\Service\Contract\WopiProofValidatorInterface;
use DateTimeImmutable;
use phpseclib3\Crypt\PublicKeyLoader;
use Psr\Http\Message\RequestInterface;
use Throwable;

use function strlen;

use const OPENSSL_ALGO_SHA256;

final class WopiProofValidator implements WopiProofValidatorInterface
{
    private ClockInterface $clock;

    private WopiDiscoveryInterface $wopiDiscovery;

    public function __construct(WopiDiscoveryInterface $wopiDiscovery, ClockInterface $clock)
    {
        $this->wopiDiscovery = $wopiDiscovery;
        $this->clock = $clock;
    }

    public function isValid(RequestInterface $request): bool
    {
        $timestamp = $request->getHeaderLine('X-WOPI-Timestamp');

        // Ensure that the X-WOPI-TimeStamp header is no more than 20 minutes old.
        $date = (new DateTimeImmutable())->setTimestamp((int) (((float) $timestamp - 621355968000000000) / 10000000));

        if (20 * 60 < ($this->clock->now()->getTimestamp() - $date->getTimestamp())) {
            return false;
        }

        $xWopiProof = $request->getHeaderLine('X-WOPI-Proof');
        $xWopiProofOld = $request->getHeaderLine('X-WOPI-ProofOld');

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
            $key = PublicKeyLoader::loadPublicKey($key);
        } catch (Throwable $e) {
            return false;
        }

        return 1 === openssl_verify(
            $expected,
            (string) base64_decode($proof, true),
            $key->toString('pkcs8'),
            OPENSSL_ALGO_SHA256
        );
    }
}
