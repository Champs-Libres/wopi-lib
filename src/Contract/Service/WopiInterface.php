<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ChampsLibres\WopiLib\Contract\Service;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface WopiInterface.
 *
 * phpcs:disable Generic.Files.LineLength.TooLong
 */
interface WopiInterface
{
    public const HEADER_EDITORS = 'X-WOPI-Editors';

    public const HEADER_ITEM_VERSION = 'X-WOPI-ItemVersion';

    public const HEADER_LOCK = 'X-WOPI-Lock';

    public const HEADER_OLD_LOCK = 'X-WOPI-OldLock';

    public const HEADER_OVERRIDE = 'X-WOPI-Override';

    public const HEADER_OVERWRITE_RELATIVE_TARGET = 'X-WOPI-OverwriteRelativeTarget';

    public const HEADER_PROOF = 'X-WOPI-Proof';

    public const HEADER_PROOF_OLD = 'X-WOPI-ProofOld';

    public const HEADER_RELATIVE_TARGET = 'X-WOPI-RelativeTarget';

    public const HEADER_REQUESTED_NAME = 'X-WOPI-RequestedName';

    public const HEADER_SIZE = 'X-WOPI-Size';

    public const HEADER_SUGGESTED_TARGET = 'X-WOPI-SuggestedTarget';

    public const HEADER_TIMESTAMP = 'X-WOPI-Timestamp';

    public const HEADER_URL_TYPE = 'X-WOPI-UrlType';

    public const HEADER_VALID_RELATIVE_TARGET = 'X-WOPI-ValidRelativeTarget';

    public function checkFileInfo(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function deleteFile(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function enumerateAncestors(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getFile(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getLock(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function getShareUrl(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function lock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function putFile(string $fileId, string $accessToken, string $xWopiLock, string $xWopiEditors, RequestInterface $request): ResponseInterface;

    public function putRelativeFile(string $fileId, string $accessToken, ?string $suggestedTarget, ?string $relativeTarget, bool $overwriteRelativeTarget, int $size, RequestInterface $request): ResponseInterface;

    public function putUserInfo(string $fileId, string $accessToken, RequestInterface $request): ResponseInterface;

    public function refreshLock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function renameFile(string $fileId, string $accessToken, string $xWopiLock, string $xWopiRequestedName, RequestInterface $request): ResponseInterface;

    public function unlock(string $fileId, string $accessToken, string $xWopiLock, RequestInterface $request): ResponseInterface;

    public function unlockAndRelock(string $fileId, string $accessToken, string $xWopiLock, string $xWopiOldLock, RequestInterface $request): ResponseInterface;
}
