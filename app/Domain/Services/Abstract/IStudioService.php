<?php
// ============================================================================
// File:    IStudioService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Exception\ValidationException;
use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Studio\ChannelsPageDTO;
use App\Support\DTOs\Studio\MusicsPageDTO;
use App\Support\DTOs\Studio\PlaylistsPageDTO;
use App\Support\DTOs\Studio\ShortsPageDTO;
use App\Support\DTOs\Studio\VideosPageDTO;

use Config\PaginationConfig;


interface IStudioService
{
    // --------------------------------------------------------------------------
    // USER
    // --------------------------------------------------------------------------

    // /**
    //  * Kullanıcı düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code kullanıcı kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kullanıcı bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return UserEditDTO
    //  */
    // public function getUserEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): UserEditDTO;

    // /**
    //  * Kullanıcının parolasını değiştirir.
    //  *
    //  * @param string $code kullanıcı kodu.
    //  * @param string $oldPassword mevcut parola.
    //  * @param string $newPassword yeni parola.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kullanıcı bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  * @throws ValidationException mevcut parola hatalıysa.
    //  *
    //  * @return void
    //  */
    // public function changeUserPassword(
    //     string $code,
    //     string $oldPassword,
    //     string $newPassword,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Yeni bir kullanıcı oluşturur.
    //  *
    //  * @param UserCreateDTO $data kullanıcı oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  * 
    //  * @return void
    //  */
    // public function createUser(
    //     UserCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Kullanıcı bilgilerini düzenler.
    //  *
    //  * @param string $code kullanıcı kodu.
    //  * @param UserEditDTO $data kullanıcı güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kullanıcı bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updateUser(
    //     string $code,
    //     UserEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Kullanıcıyı siler.
     *
     * @param string $code kullanıcı kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException kullanıcı bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deleteUser(
        string $code,
        AuthDTO $auth,
    ): void;

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının kanallarını sayfalama bilgileriyle birlikte getirir.
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
        int $perPage = PaginationConfig::STUDIO_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO;

    // /**
    //  * Kanal düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code kanal kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kanal bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return ChannelEditDTO
    //  */
    // public function getChannelEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): ChannelEditDTO;

    // /**
    //  * Yeni bir kanal oluşturur.
    //  *
    //  * @param ChannelCreateDTO $data kanal oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  * 
    //  * @return void
    //  */
    // public function createChannel(
    //     ChannelCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Kanal bilgilerini düzenler.
    //  *
    //  * @param string $code kanal kodu.
    //  * @param ChannelEditDTO $data kanal güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kanal bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updateChannel(
    //     string $code,
    //     ChannelEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Kanalı siler.
     *
     * @param string $code kanal kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException kanal bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deleteChannel(
        string $code,
        AuthDTO $auth,
    ): void;

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının videolarını sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek video sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return VideosPageDTO
     */
    public function getVideosPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_VIDEO_PER_PAGE,
    ): VideosPageDTO;

    // /**
    //  * Video düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code video kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException video bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return VideoEditDTO
    //  */
    // public function getVideoEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): VideoEditDTO;

    // /**
    //  * Yeni bir video oluşturur.
    //  *
    //  * @param VideoCreateDTO $data video oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  * 
    //  * @return void
    //  */
    // public function createVideo(
    //     VideoCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Video bilgilerini düzenler.
    //  *
    //  * @param string $code video kodu.
    //  * @param VideoEditDTO $data video güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException video bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updateVideo(
    //     string $code,
    //     VideoEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Videoyu siler.
     *
     * @param string $code video kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException video bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deleteVideo(
        string $code,
        AuthDTO $auth,
    ): void;

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının kısa videolarını sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek kısa video sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return ShortsPageDTO
     */
    public function getShortsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_SHORT_PER_PAGE,
    ): ShortsPageDTO;

    // /**
    //  * Kısa video düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code kısa video kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kısa video bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return ShortEditDTO
    //  */
    // public function getShortEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): ShortEditDTO;

    // /**
    //  * Yeni bir kısa video oluşturur.
    //  *
    //  * @param ShortCreateDTO $data kısa video oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  * 
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function createShort(
    //     ShortCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Kısa video bilgilerini düzenler.
    //  *
    //  * @param string $code kısa video kodu.
    //  * @param ShortEditDTO $data kısa video güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException kısa video bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updateShort(
    //     string $code,
    //     ShortEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Kısa videoyu siler.
     *
     * @param string $code kısa video kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException kısa video bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deleteShort(
        string $code,
        AuthDTO $auth,
    ): void;

    // --------------------------------------------------------------------------
    // MUSICS
    // --------------------------------------------------------------------------

    /**
     * Kullanıcının müziklerini sayfalama bilgileriyle birlikte getirir.
     *
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek müzik sayısı.
     *
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return MusicsPageDTO
     */
    public function getMusicsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_MUSIC_PER_PAGE,
    ): MusicsPageDTO;

    // /**
    //  * Müzik düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code müzik kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException müzik bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return MusicEditDTO
    //  */
    // public function getMusicEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): MusicEditDTO;

    // /**
    //  * Yeni bir müzik oluşturur.
    //  *
    //  * @param MusicCreateDTO $data müzik oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  * 
    //  * @return void
    //  */
    // public function createMusic(
    //     MusicCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Müzik bilgilerini düzenler.
    //  *
    //  * @param string $code müzik kodu.
    //  * @param MusicEditDTO $data müzik güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException müzik bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updateMusic(
    //     string $code,
    //     MusicEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Müziği siler.
     *
     * @param string $code müzik kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException müzik bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deleteMusic(
        string $code,
        AuthDTO $auth,
    ): void;

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
        int $perPage = PaginationConfig::STUDIO_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO;

    // /**
    //  * Oynatma listesi düzenleme sayfasında kullanılacak bilgileri getirir.
    //  *
    //  * @param string $code oynatma listesi kodu.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException oynatma listesi bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return PlaylistEditDTO
    //  */
    // public function getPlaylistEdit(
    //     string $code,
    //     AuthDTO $auth,
    // ): PlaylistEditDTO;

    // /**
    //  * Yeni bir oynatma listesi oluşturur.
    //  *
    //  * @param PlaylistCreateDTO $data oynatma listesi oluşturma bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws AuthorizationException oluşturma yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function createPlaylist(
    //     PlaylistCreateDTO $data,
    //     AuthDTO $auth,
    // ): void;

    // /**
    //  * Oynatma listesi bilgilerini düzenler.
    //  *
    //  * @param string $code oynatma listesi kodu.
    //  * @param PlaylistEditDTO $data oynatma listesi güncelleme bilgileri.
    //  * @param AuthDTO $auth mevcut kullanıcının kimliği.
    //  *
    //  * @throws NotFoundException oynatma listesi bulunamazsa.
    //  * @throws AuthorizationException düzenleme yetkisi yoksa.
    //  *
    //  * @return void
    //  */
    // public function updatePlaylist(
    //     string $code,
    //     PlaylistEditDTO $data,
    //     AuthDTO $auth,
    // ): void;

    /**
     * Oynatma listesini siler.
     *
     * @param string $code oynatma listesi kodu.
     * @param AuthDTO $auth mevcut kullanıcının kimliği.
     *
     * @throws NotFoundException oynatma listesi bulunamazsa.
     * @throws AuthorizationException silme yetkisi yoksa.
     *
     * @return void
     */
    public function deletePlaylist(
        string $code,
        AuthDTO $auth,
    ): void;
}
