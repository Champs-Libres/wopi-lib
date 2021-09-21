<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Service;

use ChampsLibres\WopiLib\Contract\Entity\Document;
use Psr\Http\Message\RequestInterface;

interface DocumentLockManagerInterface
{
    public function deleteLock(Document $document, RequestInterface $request): bool;

    public function getLock(Document $document, RequestInterface $request): string;

    public function hasLock(Document $document, RequestInterface $request): bool;

    public function setLock(Document $document, string $lockId, RequestInterface $request): bool;
}
