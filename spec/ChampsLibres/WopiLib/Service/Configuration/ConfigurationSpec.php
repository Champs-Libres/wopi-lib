<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\ChampsLibres\WopiLib\Service\Configuration;

use ChampsLibres\WopiLib\Service\Configuration\Configuration;
use PhpSpec\ObjectBehavior;

final class ConfigurationSpec extends ObjectBehavior
{
    public function it_is_created_from_an_array_of_properties()
    {
        $properties = [
            'foo' => 'foo',
            'bar' => 'bar',
        ];

        $this->beConstructedWith($properties);

        $this['foo']
            ->shouldReturn('foo');
        $this['bar']
            ->shouldReturn('bar');

        $this
            ->offsetGet('foo')
            ->shouldReturn('foo');
        $this
            ->offsetSet('abc', 'abc');

        $this
            ->offsetGet('abc')
            ->shouldReturn('abc');

        // @TODO: Disabled until phpspec/phpspec#1383 is fixed
        /*
        $this
            ->offsetExists('abc')
            ->shouldReturn(true);

        $this
            ->offsetExists('cba')
            ->shouldReturn(false);
         */
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }

    public function let()
    {
        $this->beConstructedWith([]);
    }
}
