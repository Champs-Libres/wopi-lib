<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Service\Contract;

use Psr\Http\Message\RequestInterface;

interface DocumentManagerInterface
{
    public function read(string $documentId, RequestInterface $request): array;

    public function write(string $documentId, string $content, RequestInterface $request): void;
}
