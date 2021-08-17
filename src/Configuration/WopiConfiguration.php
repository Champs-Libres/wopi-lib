<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Configuration;

use function array_key_exists;

final class WopiConfiguration implements WopiConfigurationInterface
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

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->properties);
    }

    public function offsetGet($offset)
    {
        return $this->properties[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->properties[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->properties[$offset]);
    }
}
