<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Service;

use ChampsLibres\WopiLib\Contract\Entity\Document;
use DateTimeInterface;
use Psr\Http\Message\StreamInterface;

interface DocumentManagerInterface
{
    public function create(array $data): Document;

    public function deleteLock(Document $document): void;

    public function findByDocumentFilename(string $documentFilename): ?Document;

    public function findByDocumentId(string $documentId): ?Document;

    public function getBasename(Document $document): string;

    public function getCreationDate(Document $document): DateTimeInterface;

    public function getDocumentId(Document $document): string;

    public function getLastModifiedDate(Document $document): DateTimeInterface;

    public function getLock(Document $document): string;

    public function getSha256(Document $document): string;

    public function getSize(Document $document): int;

    public function getVersion(Document $document): string;

    public function hasLock(Document $document): bool;

    public function lock(Document $document, string $lock): void;

    public function read(Document $document): StreamInterface;

    public function remove(Document $document): void;

    public function write(Document $document, array $properties = []): void;
}
