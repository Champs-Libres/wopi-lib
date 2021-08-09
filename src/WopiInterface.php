<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface WopiInterface.
 *
 * phpcs:disable Generic.Files.LineLength.TooLong
 */
interface WopiInterface
{
    public function checkFileInfo(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function deleteFile(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function enumerateAncestors(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getFile(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getLock(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getShareUrl(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function lock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function putFile(string $fileId, string $accessToken, string $xWopiLock, string $xWopiEditors, RequestInterface $request): ResponseInterface;

    public function putRelativeFile(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function putUserInfo(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function refreshLock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function renameFile(string $fileId, string $accessToken, string $xWopiLock, string $xWopiRequestedName, RequestInterface $request): ResponseInterface;

    public function unlock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function unlockAndRelock(string $fileId, string $accessToken, string $xWopiLock, string $xWopiOldLock, RequestInterface $request): ResponseInterface;
}
