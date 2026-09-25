<?php
// ============================================================================
// File:    StudioService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Services\Abstract\IStudioService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Studio\ChannelsPageDTO;
use App\Support\DTOs\Studio\MusicsPageDTO;
use App\Support\DTOs\Studio\PlaylistsPageDTO;
use App\Support\DTOs\Studio\ShortsPageDTO;
use App\Support\DTOs\Studio\VideosPageDTO;

use Config\PaginationConfig;


class StudioService implements IStudioService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct() {}

    // --------------------------------------------------------------------------
    // USER
    // --------------------------------------------------------------------------

    public function deleteUser(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannelsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function deleteChannel(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    public function getVideosPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_VIDEO_PER_PAGE,
    ): VideosPageDTO {
        throw new \Exception('Not implemented');
    }

    public function deleteVideo(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getShortsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_SHORT_PER_PAGE,
    ): ShortsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function deleteShort(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // MUSICS
    // --------------------------------------------------------------------------

    public function getMusicsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_MUSIC_PER_PAGE,
    ): MusicsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function deleteMusic(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylistsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function deletePlaylist(
        string $code,
        AuthDTO $auth,
    ): void {
        throw new \Exception('Not implemented');
    }
}
