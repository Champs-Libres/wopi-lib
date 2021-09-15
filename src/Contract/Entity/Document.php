<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Entity;

interface Document
{
    public function getBasename(): string;

    public function getContent();

    public function getExtension(): string;

    public function getFileId(): string;

    public function getFilename(): string;

    public function getId(): int;

    public function getSha256(): string;

    public function getSize(): string;

    public static function new(array $data): self;

    /**
     * @param string $basename A filename with extension
     */
    public function setBasename(string $basename): void;

    public function setContent(string $content): void;

    public function setExtension(string $extension): void;

    /**
     * @param string $filename A filename without extension
     */
    public function setFilename(string $filename): void;

    public function setSize(string $size): void;
}
