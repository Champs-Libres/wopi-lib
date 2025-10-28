<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service\Configuration;

use ChampsLibres\WopiLib\Contract\Service\Configuration\ConfigurationInterface;

use function array_key_exists;

final class Configuration implements ConfigurationInterface
{
    private array $properties;

    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public function jsonSerialize(): array
    {
        return $this->properties;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->properties);
    }

    public function offsetGet($offset): mixed
    {
        return $this->properties[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->properties[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->properties[$offset]);
    }
}
