<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service\Utils;

use ChampsLibres\WopiLib\Contract\Service\Utils\DotNetTimeConverterInterface;
use DateTimeImmutable;
use DateTimeInterface;

final class DotNetTimeConverter implements DotNetTimeConverterInterface
{
    private const MULTIPLIER = 1e7;

    private const OFFSET = 621355968e9;

    public function toDatetime(string $ticks): DateTimeInterface
    {
        return DateTimeImmutable::createFromFormat(
            'U',
            (string) ((int) (((float) $ticks - self::OFFSET) / self::MULTIPLIER))
        );
    }

    public function toTicks(DateTimeInterface $datetime): string
    {
        return (string) (int) (($datetime->getTimestamp() * self::MULTIPLIER) + self::OFFSET);
    }
}
