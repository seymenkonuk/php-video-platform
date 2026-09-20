<?php
// ============================================================================
// File:    PlaylistService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Services\Abstract\IPlaylistService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Playlist\PageDTO;
use App\Support\DTOs\Playlist\PaginatedDTO;

use Config\PaginationConfig;


class PlaylistService implements IPlaylistService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IPlaylistRepository $playlistRepository,
    ) {}

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylists(
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_PER_PAGE,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    public function getPlaylistPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO {
        throw new \Exception('Not implemented');
    }
}
