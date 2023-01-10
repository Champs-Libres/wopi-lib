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
    /**
     * Create a document
     *
     * @param array{basename: string, name: string, extension: string, content: string, size: numeric-string} $data
     */
    public function create(array $data): Document;

    /**
     * Delete an existing lock attached to the document.
     */
    public function deleteLock(Document $document): void;

    public function findByDocumentFilename(string $documentFilename): ?Document;

    public function findByDocumentId(string $documentId): ?Document;

    public function getBasename(Document $document): string;

    public function getCreationDate(Document $document): DateTimeInterface;

    public function getDocumentId(Document $document): string;

    public function getLastModifiedDate(Document $document): DateTimeInterface;

    public function getLock(Document $document): string;

    /**
     * Get a sha256 from the document's content.
     *
     * This is used for caching purpose in the client (see https://learn.microsoft.com/en-us/microsoft-365/cloud-storage-partner-program/rest/files/checkfileinfo/checkfileinfo-other#sha256)
     *
     * @param Document $document
     * @return string
     */
    public function getSha256(Document $document): string;

    public function getSize(Document $document): int;

    /**
     * Get version for this document.
     *
     * Note that CollaboraOnline does not rely on this document's version for detect change, but on
     * @link{DocumentManagerInterface::getLastModifiedTime}
     * @param Document $document
     * @return string
     */
    public function getVersion(Document $document): string;

    public function hasLock(Document $document): bool;

    /**
     * Write a lock on the document.
     *
     * The lock should last 30 minutes. It will be renewed by Wopi client if needed.
     *
     * @param Document $document
     * @param string $lock
     * @return void
     */
    public function lock(Document $document, string $lock): void;

    public function read(Document $document): StreamInterface;

    public function remove(Document $document): void;

    /**
     * Write the content into the document.
     *
     * **Important**: any implementation should also ensure to update the version and timestamp
     * of the Document, after writing data.
     *
     * @param Document $document
     * @param array{content: string, size: int} $properties
     * @return void
     */
    public function write(Document $document, array $properties = []): void;

    public function rename(Document $document, string $requestedName): void;
}
