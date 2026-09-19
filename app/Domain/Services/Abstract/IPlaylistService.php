<?php
// ============================================================================
// File:    IPlaylistService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\AuthorizationException;
use Seymenkonuk\Framework\Http\Exception\NotFoundException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Playlist\PageDTO;
use App\Support\DTOs\Playlist\PaginatedDTO;


use Config\PaginationConfig;


interface IPlaylistService
{
    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık oynatma listelerini sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek oynatma listesi sayısı.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getPlaylists(
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_PER_PAGE,
    ): PaginatedDTO;

    /**
     * Oynatma listesi sayfasında kullanılacak verileri getirir.
     *
     * @param string $code oynatma listesi kodu.
     * @param ?AuthDTO $auth oynatma listesini görüntüleyen kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     * @throws AuthorizationException oynatma listesini görüntüleme yetkisi yoksa.
     *
     * @return PageDTO
     */
    public function getPlaylistPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO;

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    // video ekle
    // video çıkart
}
