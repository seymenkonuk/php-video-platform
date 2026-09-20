<?php
// ============================================================================
// File:    ChannelService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Services\Abstract\IChannelService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Channel\AboutPageDTO;
use App\Support\DTOs\Channel\HomePageDTO;
use App\Support\DTOs\Channel\MusicsPageDTO;
use App\Support\DTOs\Channel\PaginatedDTO;
use App\Support\DTOs\Channel\PlaylistsPageDTO;
use App\Support\DTOs\Channel\ShortsPageDTO;
use App\Support\DTOs\Channel\SubscriptionsPageDTO;
use App\Support\DTOs\Channel\VideosPageDTO;

use Config\PaginationConfig;


class ChannelService implements IChannelService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IVideoRepository $videoRepository,
        protected IShortRepository $shortRepository,
        protected IMusicRepository $musicRepository,
        protected IPlaylistRepository $playlistRepository,
    ) {}

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannels(
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // CHANNEL
    // --------------------------------------------------------------------------

    public function getChannelHomePage(
        string $code,
        ?AuthDTO $auth = null,
    ): HomePageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelVideosPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_VIDEO_PER_PAGE,
        ?AuthDTO $auth = null,
    ): VideosPageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelShortsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_SHORT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): ShortsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelMusicsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_MUSIC_PER_PAGE,
        ?AuthDTO $auth = null,
    ): MusicsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelPlaylistsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PLAYLIST_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PlaylistsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelSubscriptionsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): SubscriptionsPageDTO {
        throw new \Exception('Not implemented');
    }

    public function getChannelAboutPage(
        string $code,
        ?AuthDTO $auth = null,
    ): AboutPageDTO {
        throw new \Exception('Not implemented');
    }
}
