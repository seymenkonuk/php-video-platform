<?php
// ============================================================================
// File:    IShortService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Short\PageDTO;
use App\Support\DTOs\Short\PaginatedDTO;

use Config\PaginationConfig;


interface IShortService
{
    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kısa videoları sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek kısa video sayısı.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getShorts(
        int $page,
        int $perPage = PaginationConfig::SHORT_PER_PAGE,
    ): PaginatedDTO;

    /**
     * Kısa video izleme sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kısa video kodu.
     * @param ?AuthDTO $auth kısa videoyu görüntüleyen kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException kısa videoyu görüntüleme yetkisi yoksa.
     *
     * @return PageDTO
     */
    public function getShortPage(
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
