<?php
// ============================================================================
// File:    IChannelService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;

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


interface IChannelService
{
    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kanalları sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek kanal sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getChannels(
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PaginatedDTO;

    // --------------------------------------------------------------------------
    // CHANNEL
    // --------------------------------------------------------------------------

    /**
     * Kanal ana sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     *
     * @return HomePageDTO
     */
    public function getChannelHomePage(
        string $code,
        ?AuthDTO $auth = null,
    ): HomePageDTO;

    /**
     * Kanalın videoları sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return VideosPageDTO
     */
    public function getChannelVideosPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_VIDEO_PER_PAGE,
        ?AuthDTO $auth = null,
    ): VideosPageDTO;

    /**
     * Kanalın kısa videoları sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return ShortsPageDTO
     */
    public function getChannelShortsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_SHORT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): ShortsPageDTO;

    /**
     * Kanalın müzikleri sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return MusicsPageDTO
     */
    public function getChannelMusicsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_MUSIC_PER_PAGE,
        ?AuthDTO $auth = null,
    ): MusicsPageDTO;

    /**
     * Kanalın oynatma listeleri sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return PlaylistsPageDTO
     */
    public function getChannelPlaylistsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_PLAYLIST_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PlaylistsPageDTO;

    /**
     * Kanalın abone olduğu kanallar sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek içerik sayısı.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return SubscriptionsPageDTO
     */
    public function getChannelSubscriptionsPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CHANNEL_CHANNEL_PER_PAGE,
        ?AuthDTO $auth = null,
    ): SubscriptionsPageDTO;

    /**
     * Kanal hakkında sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kanal kodu.
     * @param ?AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException $code bulunamazsa.
     *
     * @return AboutPageDTO
     */
    public function getChannelAboutPage(
        string $code,
        ?AuthDTO $auth = null,
    ): AboutPageDTO;

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    // kanal abone ol
    // kanal abonelikten çık
}
