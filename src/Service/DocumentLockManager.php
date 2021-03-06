<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Contract\Entity\Document;
use ChampsLibres\WopiLib\Contract\Service\DocumentLockManagerInterface;
use DateInterval;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;

final class DocumentLockManager implements DocumentLockManagerInterface
{
    private CacheItemPoolInterface $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function deleteLock(Document $document, RequestInterface $request): bool
    {
        // instead of deleting the lock, set a short expiration time
        // it gives a chance for concurrent request which put the file content
        // to meet an existing lock, and avoid them to be banned
        $item = $this->cache->getItem($this->getCacheId($document->getWopiDocId()));

        $item->expiresAfter(new DateInterval('PT10S'));

        return $this->cache->save($item);
    }

    public function getLock(Document $document, RequestInterface $request): string
    {
        return $this->cache->getItem($this->getCacheId($document->getWopiDocId()))->get();
    }

    public function hasLock(Document $document, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($document->getWopiDocId()));

        return $item->isHit();
    }

    public function setLock(Document $document, string $lockId, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($document->getWopiDocId()));

        $item->set($lockId);
        // according to the specs, lock should last 30M
        $item->expiresAfter(new DateInterval('PT31M'));

        return $this->cache->save($item);
    }

    private function getCacheId(string $documentId): string
    {
        return sprintf('wopi_lib_lock_%s', $documentId);
    }
}
