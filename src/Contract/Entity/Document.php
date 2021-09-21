<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Entity;

interface Document
{
    public function getWopiBasename(): string;

    /**
     * @return resource|string
     */
    public function getWopiContent();

    public function getWopiExtension(): string;

    public function getWopiFileId(): string;

    public function getWopiFilename(): string;

    public function getWopiSha256(): string;

    public function getWopiSize(): string;

    public static function newWopi(array $data): self;

    public function setWopiBasename(string $basename): void;

    public function setWopiContent(string $content): void;

    public function setWopiExtension(string $extension): void;

    /**
     * @param string $filename A filename without extension
     */
    public function setWopiFilename(string $filename): void;

    public function setWopiSize(string $size): void;
}
