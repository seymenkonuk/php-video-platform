<?php
// ============================================================================
// File:    IMusicService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Music\InteractionDTO;
use App\Support\DTOs\Music\PageDTO;
use App\Support\DTOs\Music\PaginatedDTO;

use Config\PaginationConfig;


interface IMusicService
{
    // --------------------------------------------------------------------------
    // MUSICS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık müzikleri sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek müzik sayısı.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getMusics(
        int $page,
        int $perPage = PaginationConfig::MUSIC_PER_PAGE,
    ): PaginatedDTO;

    /**
     * Müzik izleme sayfasında kullanılacak verileri getirir.
     *
     * @param string $code müzik kodu.
     * @param ?AuthDTO $auth müziği görüntüleyen kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException müziği görüntüleme yetkisi yoksa.
     *
     * @return PageDTO
     */
    public function getMusicPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO;

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    /**
     * Müzik beğenme durumunu değiştirir.
     *
     * @param string $code müzik kodu.
     * @param AuthDTO $auth işlemi gerçekleştiren kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException müziği görüntüleme yetkisi yoksa.
     *
     * @return InteractionDTO
     */
    public function toggleLike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO;

    /**
     * Müzik beğenmeme durumunu değiştirir.
     *
     * @param string $code müzik kodu.
     * @param AuthDTO $auth işlemi gerçekleştiren kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException müziği görüntüleme yetkisi yoksa.
     *
     * @return InteractionDTO
     */
    public function toggleDislike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO;

    /**
     * Müziğin daha sonra izlenecekler listesindeki durumunu değiştirir.
     *
     * @param string $code müzik kodu.
     * @param AuthDTO $auth işlemi gerçekleştiren kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     * @throws AuthorizationException müziği görüntüleme yetkisi yoksa.
     *
     * @return bool
     */
    public function toggleWatchLater(
        string $code,
        AuthDTO $auth,
    ): bool;
}
