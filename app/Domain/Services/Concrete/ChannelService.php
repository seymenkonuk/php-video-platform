<?php
// ============================================================================
// File:    ChannelService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\ChannelNotFoundException;
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
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ChannelToAboutDtoMapper;
use App\Support\Mappers\ChannelToCardDtoMapper;
use App\Support\Mappers\ChannelToHeaderDtoMapper;
use App\Support\Mappers\MusicToCardDtoMapper;
use App\Support\Mappers\PlaylistToCardDtoMapper;
use App\Support\Mappers\ShortToCardDtoMapper;
use App\Support\Mappers\VideoToCardDtoMapper;

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
        protected ChannelToAboutDtoMapper $channelAboutMapper,
        protected ChannelToCardDtoMapper $channelCardMapper,
        protected ChannelToHeaderDtoMapper $channelHeaderMapper,
        protected VideoToCardDtoMapper $videoCardMapper,
        protected ShortToCardDtoMapper $shortCardMapper,
        protected MusicToCardDtoMapper $musicCardMapper,
        protected PlaylistToCardDtoMapper $playlistCardMapper,
    ) {}

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannels(
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PaginatedDTO {
        // Public Kanalları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->channelRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->channelRepository->yieldPublic($offset, $limit, $auth?->channel->code),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            channels: $this->channelCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // CHANNEL
    // --------------------------------------------------------------------------

    public function getChannelHomePage(
        string $code,
        ?AuthDTO $auth = null,
    ): HomePageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // DTO'ya Dönüştür
        return new HomePageDTO(
            header: $this->channelHeaderMapper->map($details),
        );
    }

    public function getChannelVideosPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_VIDEO_PER_PAGE,
        ?AuthDTO $auth = null,
    ): VideosPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // Kanal Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->videoRepository->countPublicByChannel($code),
            $perPage,
            fn($offset, $limit) => $this->videoRepository->yieldPublicByChannel($code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new VideosPageDTO(
            header: $this->channelHeaderMapper->map($details),
            videos: $this->videoCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelShortsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_SHORT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): ShortsPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // Kanal Kısa Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->shortRepository->countPublicByChannel($code),
            $perPage,
            fn($offset, $limit) => $this->shortRepository->yieldPublicByChannel($code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new ShortsPageDTO(
            header: $this->channelHeaderMapper->map($details),
            shorts: $this->shortCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelMusicsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_MUSIC_PER_PAGE,
        ?AuthDTO $auth = null,
    ): MusicsPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // Kanal Müziklerini Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->musicRepository->countPublicByChannel($code),
            $perPage,
            fn($offset, $limit) => $this->musicRepository->yieldPublicByChannel($code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new MusicsPageDTO(
            header: $this->channelHeaderMapper->map($details),
            musics: $this->musicCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelPlaylistsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PLAYLIST_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PlaylistsPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // Kanal Oynatma Listelerini Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->playlistRepository->countPublicByChannel($code),
            $perPage,
            fn($offset, $limit) => $this->playlistRepository->yieldPublicByChannel($code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PlaylistsPageDTO(
            header: $this->channelHeaderMapper->map($details),
            playlists: $this->playlistCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelSubscriptionsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): SubscriptionsPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kanal Bulunamadı
        if (!$details) {
            throw new ChannelNotFoundException();
        }

        // Kanal Aboneliklerini Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->channelRepository->countPublicBySubscriber($code),
            $perPage,
            fn($offset, $limit) => $this->channelRepository->yieldPublicBySubscriber($code, $offset, $limit, $auth?->channel->code),
        );

        // DTO'ya Dönüştür
        return new SubscriptionsPageDTO(
            header: $this->channelHeaderMapper->map($details),
            channels: $this->channelCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelAboutPage(
        string $code,
        ?AuthDTO $auth = null,
    ): AboutPageDTO {
        // Kanal Detaylarını Al
        $details = $this->channelRepository->findDetailsByCode($code, $auth?->channel->code);
        $about = $this->channelRepository->findStatisticsByCode($code);

        // Kanal Bulunamadı
        if (!$details || !$about) {
            throw new ChannelNotFoundException();
        }

        // DTO'ya Dönüştür
        return new AboutPageDTO(
            header: $this->channelHeaderMapper->map($details),
            about: $this->channelAboutMapper->map($about),
        );
    }
}
