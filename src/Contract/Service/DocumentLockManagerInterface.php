<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Service;

use Psr\Http\Message\RequestInterface;

interface DocumentLockManagerInterface
{
    public function deleteLock(string $documentId, RequestInterface $request): bool;

    public function getLock(string $documentId, RequestInterface $request): string;

    public function hasLock(string $documentId, RequestInterface $request): bool;

    public function setLock(string $documentId, string $lockId, RequestInterface $request): bool;
}