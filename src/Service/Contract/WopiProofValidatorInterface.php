<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service\Contract;

use Psr\Http\Message\RequestInterface;

interface WopiProofValidatorInterface
{
    public function isValid(RequestInterface $request): bool;
}
