<?php
// ============================================================================
// File:    IVideoService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Video\PageDTO;
use App\Support\DTOs\Video\PaginatedDTO;

use Config\PaginationConfig;


interface IVideoService
{
    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık videoları sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek video sayısı.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getVideos(
        int $page,
        int $perPage = PaginationConfig::VIDEO_PER_PAGE,
    ): PaginatedDTO;

    /**
     * Video izleme sayfasında kullanılacak verileri getirir.
     *
     * @param string $code video kodu.
     * @param ?AuthDTO $auth videoyu görüntüleyen kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException videoyu görüntüleme yetkisi yoksa.
     *
     * @return PageDTO
     */
    public function getVideoPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO;

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    // like
    // dislike
    // toggleWatchLater
}
