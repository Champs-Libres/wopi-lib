<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service;

use ChampsLibres\WopiLib\Contract\Entity\Document;
use ChampsLibres\WopiLib\Contract\Service\DocumentLockManagerInterface;
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
        return $this->cache->deleteItem($this->getCacheId($document->getWopiFileId()));
    }

    public function getLock(Document $document, RequestInterface $request): string
    {
        return $this->cache->getItem($this->getCacheId($document->getWopiFileId()))->get();
    }

    public function hasLock(Document $document, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($document->getWopiFileId()));

        return $item->isHit();
    }

    public function setLock(Document $document, string $lockId, RequestInterface $request): bool
    {
        $item = $this->cache->getItem($this->getCacheId($document->getWopiFileId()));

        $item->set($lockId);

        return $this->cache->save($item);
    }

    private function getCacheId(string $documentId): string
    {
        return sprintf('wopi_lib_lock_%s', $documentId);
    }
}
