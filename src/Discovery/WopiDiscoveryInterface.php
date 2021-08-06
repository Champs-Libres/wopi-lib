<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Discovery;

interface WopiDiscoveryInterface
{
    public function refresh(): void;

    public function getCapabilities(): array;

    public function discoverExtension(string $extension): array;

}
