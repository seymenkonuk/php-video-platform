<?php
// ============================================================================
// File:    FeedService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IHistoryRepository;
use App\Domain\Repositories\Abstract\ILikedRepository;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\ISubscriptionRepository;
use App\Domain\Repositories\Abstract\IWatchLaterRepository;
use App\Domain\Services\Abstract\IFeedService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Feed\ChannelsPageDTO;
use App\Support\DTOs\Feed\CommentsPageDTO;
use App\Support\DTOs\Feed\HistoryPageDTO;
use App\Support\DTOs\Feed\LikedPageDTO;
use App\Support\DTOs\Feed\PlaylistsPageDTO;
use App\Support\DTOs\Feed\SubscriptionsPageDTO;
use App\Support\DTOs\Feed\WatchLaterPageDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ChannelToCardDtoMapper;
use App\Support\Mappers\HistoryToHeaderDtoMapper;
use App\Support\Mappers\LikedToHeaderDtoMapper;
use App\Support\Mappers\PlaylistToCardDtoMapper;
use App\Support\Mappers\VideoToPlaylistItemDtoMapper;
use App\Support\Mappers\WatchLaterToHeaderDtoMapper;

use Config\PaginationConfig;


class FeedService implements IFeedService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IPlaylistRepository $playlistRepository,
        protected ILikedRepository $likedRepository,
        protected IHistoryRepository $historyRepository,
        protected IWatchLaterRepository $watchLaterRepository,
        protected ISubscriptionRepository $subscriptionRepository,
        protected ChannelToCardDtoMapper $channelCardMapper,
        protected PlaylistToCardDtoMapper $playlistCardMapper,
        protected VideoToPlaylistItemDtoMapper $videoPlaylistItemMapper,
        protected LikedToHeaderDtoMapper $likedHeaderMapper,
        protected HistoryToHeaderDtoMapper $historyHeaderMapper,
        protected WatchLaterToHeaderDtoMapper $watchLaterHeaderMapper,
    ) {}

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannelsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO {
        // Abone Olduğum Kanalları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->channelRepository->countPublicBySubscriber($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->channelRepository->yieldPublicBySubscriber($auth->channel->code, $offset, $limit, $auth->channel->code),
        );

        // DTO'ya Dönüştür
        return new ChannelsPageDTO(
            channels: $this->channelCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // SUBSCRIPTIONS
    // --------------------------------------------------------------------------

    public function getSubscriptionsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_SUBSCRIPTION_CONTENT_PER_PAGE,
    ): SubscriptionsPageDTO {
        // Oynatma Listelerimi Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->subscriptionRepository->countPublicBySubscriber($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->subscriptionRepository->yieldPublicBySubscriber($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new SubscriptionsPageDTO(
            videos: $this->videoPlaylistItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // COMMENTS
    // --------------------------------------------------------------------------

    public function getCommentsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_COMMENT_PER_PAGE,
    ): CommentsPageDTO {
        // DTO'ya Dönüştür
        return new CommentsPageDTO(
            comments: (function () {
                yield from [];
            })(),
            pagination: new \App\Support\DTOs\UI\PaginationDTO(1, 1, $perPage, 0, 0),
        );
    }

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylistsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO {
        // Oynatma Listelerimi Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->playlistRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->playlistRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PlaylistsPageDTO(
            playlists: $this->playlistCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // WATCH LATER
    // --------------------------------------------------------------------------

    public function getWatchLaterPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::WATCH_LATER_CONTENT_PER_PAGE,
    ): WatchLaterPageDTO {
        // Oynatma Listesi Detaylarını Al
        $details = $this->watchLaterRepository->findDetailsByChannel($auth->channel->code);
        assert($details !== null);

        // Oynatma Listesi Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->watchLaterRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->watchLaterRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // Videoları Görüntüleme Yetkisine Göre Filtrele
        $videos = (function () use ($page, $perPage, $paginated, $auth) {
            $index = ($page - 1) * $perPage;
            foreach ($paginated["data"] as $video) {
                $index++;
                if (VideoPolicy::canList($auth, $video)) {
                    yield $this->videoPlaylistItemMapper->map($video, "WL", $index);
                } else {
                    yield null;
                }
            }
        })();

        // DTO'ya Dönüştür
        return new WatchLaterPageDTO(
            header: $this->watchLaterHeaderMapper->map($details),
            videos: $videos,
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // HISTORY
    // --------------------------------------------------------------------------

    public function getHistoryPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::HISTORY_CONTENT_PER_PAGE,
    ): HistoryPageDTO {
        // Oynatma Listesi Detaylarını Al
        $details = $this->historyRepository->findDetailsByChannel($auth->channel->code);
        assert($details !== null);

        // Oynatma Listesi Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->historyRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->historyRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // Videoları Görüntüleme Yetkisine Göre Filtrele
        $videos = (function () use ($page, $perPage, $paginated, $auth) {
            $index = ($page - 1) * $perPage;
            foreach ($paginated["data"] as $video) {
                $index++;
                if (VideoPolicy::canList($auth, $video)) {
                    yield $this->videoPlaylistItemMapper->map($video, "HL", $index);
                } else {
                    yield null;
                }
            }
        })();

        // DTO'ya Dönüştür
        return new HistoryPageDTO(
            header: $this->historyHeaderMapper->map($details),
            videos: $videos,
            pagination: $paginated["pagination"],
        );
    }

    // --------------------------------------------------------------------------
    // LIKED
    // --------------------------------------------------------------------------

    public function getLikedPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::LIKED_CONTENT_PER_PAGE,
    ): LikedPageDTO {
        // Oynatma Listesi Detaylarını Al
        $details = $this->likedRepository->findDetailsByChannel($auth->channel->code);
        assert($details !== null);

        // Oynatma Listesi Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->likedRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->likedRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // Videoları Görüntüleme Yetkisine Göre Filtrele
        $videos = (function () use ($page, $perPage, $paginated, $auth) {
            $index = ($page - 1) * $perPage;
            foreach ($paginated["data"] as $video) {
                $index++;
                if (VideoPolicy::canList($auth, $video)) {
                    yield $this->videoPlaylistItemMapper->map($video, "LL", $index);
                } else {
                    yield null;
                }
            }
        })();

        // DTO'ya Dönüştür
        return new LikedPageDTO(
            header: $this->likedHeaderMapper->map($details),
            videos: $videos,
            pagination: $paginated["pagination"],
        );
    }
}
