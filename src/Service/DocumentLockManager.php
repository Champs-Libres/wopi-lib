<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Service\Contract\DocumentLockManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;

final class DocumentLockManager implements DocumentLockManagerInterface
{
    private CacheItemPoolInterface $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function deleteLock(string $documentId, RequestInterface $request): bool
    {
        return $this->cache->deleteItem($this->getCacheId($documentId));
    }

    public function getLock(string $documentId, RequestInterface $request): string
    {
        return $this->cache->getItem($this->getCacheId($documentId))->get();
    }

    public function hasLock(string $documentId, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($documentId));

        return $item->isHit();
    }

    public function setLock(string $documentId, string $lockId, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($documentId));

        $item->set($lockId);

        return $this->cache->save($item);
    }

    private function getCacheId(string $documentId): string
    {
        return sprintf('wopi_lib_lock_%s', $documentId);
    }
}
