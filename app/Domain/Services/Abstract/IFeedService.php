<?php
// ============================================================================
// File:    IFeedService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Feed\ChannelsPageDTO;
use App\Support\DTOs\Feed\CommentsPageDTO;
use App\Support\DTOs\Feed\HistoryPageDTO;
use App\Support\DTOs\Feed\LikedPageDTO;
use App\Support\DTOs\Feed\PlaylistsPageDTO;
use App\Support\DTOs\Feed\SubscriptionsPageDTO;
use App\Support\DTOs\Feed\WatchLaterPageDTO;

use Config\PaginationConfig;


interface IFeedService
{
    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının takip ettiği kanalları sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek kanal sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return ChannelsPageDTO
     */
    public function getChannelsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO;

    // --------------------------------------------------------------------------
    // SUBSCRIPTIONS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının takip ettiği kanalların içeriklerini sayfalama bilgileriyle
     * birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return SubscriptionsPageDTO
     */
    public function getSubscriptionsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_SUBSCRIPTION_CONTENT_PER_PAGE,
    ): SubscriptionsPageDTO;

    // --------------------------------------------------------------------------
    // COMMENTS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının yorumlarını sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek yorum sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return CommentsPageDTO
     */
    public function getCommentsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_COMMENT_PER_PAGE,
    ): CommentsPageDTO;

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının oynatma listelerini sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek oynatma listesi sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PlaylistsPageDTO
     */
    public function getPlaylistsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::FEED_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO;

    // --------------------------------------------------------------------------
    // WATCH LATER
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının daha sonra izle içeriklerini sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return WatchLaterPageDTO
     */
    public function getWatchLaterPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::WATCH_LATER_CONTENT_PER_PAGE,
    ): WatchLaterPageDTO;

    // --------------------------------------------------------------------------
    // HISTORY
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının izleme geçmişini sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return HistoryPageDTO
     */
    public function getHistoryPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::HISTORY_CONTENT_PER_PAGE,
    ): HistoryPageDTO;

    // --------------------------------------------------------------------------
    // LIKED
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının beğendiği içerikleri sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return LikedPageDTO
     */
    public function getLikedPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::LIKED_CONTENT_PER_PAGE,
    ): LikedPageDTO;
}
