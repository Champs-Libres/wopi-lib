<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Service\Discovery;

interface DiscoveryInterface
{
    /**
     * @return list<array<string, string>>
     */
    public function discoverExtension(string $extension): array;

    /**
     * @return list<array<string, string>>
     */
    public function discoverMimeType(string $mimeType): array;

    /**
     * @return array<string, mixed>
     */
    public function getCapabilities(): array;

    /**
     * @return string The MSBLOB key is the "value" attribute in the proof-key tag in the hosting/capabilities xml
     */
    public function getPublicKey(): string;

    /**
     * @return string The MSBLOB oldkey is the "oldvalue" attribute in the proof-key tag in the hosting/capabilities xml
     */
    public function getPublicKeyOld(): string;
}
