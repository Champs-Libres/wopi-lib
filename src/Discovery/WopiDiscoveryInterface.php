<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Discovery;

interface WopiDiscoveryInterface
{
    /**
     * @return list<array<string, string>>
     */
    public function discoverExtension(string $extension): array;

    /**
     * @return array<string, mixed>
     */
    public function getCapabilities(): array;
}
