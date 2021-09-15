<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\ChampsLibres\WopiLib\Service\Utils;

use ChampsLibres\WopiLib\Service\Utils\DotNetTimeConverter;
use DateTimeImmutable;
use DateTimeInterface;
use PhpSpec\ObjectBehavior;

class DotNetTimeConverterSpec extends ObjectBehavior
{
    public function it_convert_a_datetime_into_ticks()
    {
        $subject = $this
            ->toTicks(DateTimeImmutable::createFromFormat('U', '1630873496'));

        $subject
            ->shouldBeString();

        $subject
            ->shouldBeEqualTo('637664702960000000');
    }

    public function it_convert_ticks_into_a_datetime()
    {
        $subject = $this
            ->toDatetime('637664702964021765');

        $subject
            ->shouldBeAnInstanceOf(DateTimeInterface::class);

        $subject
            ->getTimestamp()
            ->shouldReturn(1630873496);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DotNetTimeConverter::class);
    }
}
