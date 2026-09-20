<?php
// ============================================================================
// File:    FeedService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Services\Abstract\IFeedService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Feed\ChannelsPageDTO;
use App\Support\DTOs\Feed\CommentsPageDTO;
use App\Support\DTOs\Feed\HistoryPageDTO;
use App\Support\DTOs\Feed\LikedPageDTO;
use App\Support\DTOs\Feed\PlaylistsPageDTO;
use App\Support\DTOs\Feed\SubscriptionsPageDTO;
use App\Support\DTOs\Feed\WatchLaterPageDTO;

use Config\PaginationConfig;


class FeedService implements IFeedService
{
    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannelsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // SUBSCRIPTIONS
    // --------------------------------------------------------------------------

    public function getSubscriptionsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_SUBSCRIPTION_CONTENT_PER_PAGE,
    ): SubscriptionsPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // COMMENTS
    // --------------------------------------------------------------------------

    public function getCommentsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_COMMENT_PER_PAGE,
    ): CommentsPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylistsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // WATCH LATER
    // --------------------------------------------------------------------------

    public function getWatchLaterPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::WATCH_LATER_CONTENT_PER_PAGE,
    ): WatchLaterPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // HISTORY
    // --------------------------------------------------------------------------

    public function getHistoryPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::HISTORY_CONTENT_PER_PAGE,
    ): HistoryPageDTO {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // LIKED
    // --------------------------------------------------------------------------

    public function getLikedPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::LIKED_CONTENT_PER_PAGE,
    ): LikedPageDTO {
        throw new \Exception('Not implemented');
    }
}
