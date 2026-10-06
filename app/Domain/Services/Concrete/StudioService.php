<?php
// ============================================================================
// File:    StudioService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\ChannelNotFoundException;
use App\Domain\Exception\NotFound\MusicNotFoundException;
use App\Domain\Exception\NotFound\PlaylistNotFoundException;
use App\Domain\Exception\NotFound\ShortNotFoundException;
use App\Domain\Exception\NotFound\UserNotFoundException;
use App\Domain\Exception\NotFound\VideoNotFoundException;
use App\Domain\Exception\Permission\Delete\ChannelDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Delete\MusicDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Delete\PlaylistDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Delete\ShortDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Delete\UserDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Delete\VideoDeletePermissionDeniedException;
use App\Domain\Exception\Permission\Edit\ChannelEditPermissionDeniedException;
use App\Domain\Exception\Permission\Edit\MusicEditPermissionDeniedException;
use App\Domain\Exception\Permission\Edit\PlaylistEditPermissionDeniedException;
use App\Domain\Exception\Permission\Edit\ShortEditPermissionDeniedException;
use App\Domain\Exception\Permission\Edit\UserEditPermissionDeniedException;
use App\Domain\Exception\Permission\Edit\VideoEditPermissionDeniedException;
use App\Domain\Policies\ChannelPolicy;
use App\Domain\Policies\PlaylistPolicy;
use App\Domain\Policies\UserPolicy;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Repositories\Abstract\IUserRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Services\Abstract\IStudioService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Studio\ChannelsPageDTO;
use App\Support\DTOs\Studio\MusicsPageDTO;
use App\Support\DTOs\Studio\PlaylistsPageDTO;
use App\Support\DTOs\Studio\ShortsPageDTO;
use App\Support\DTOs\Studio\VideosPageDTO;
use App\Support\DTOs\User\EditDTO as UserEditDTO;
use App\Support\DTOs\Channel\EditDTO as ChannelEditDTO;
use App\Support\DTOs\Playlist\EditDTO as PlaylistEditDTO;
use App\Support\DTOs\Video\EditDTO as VideoEditDTO;
use App\Support\DTOs\Short\EditDTO as ShortEditDTO;
use App\Support\DTOs\Music\EditDTO as MusicEditDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ChannelToEditDtoMapper;
use App\Support\Mappers\ChannelToListItemDtoMapper;
use App\Support\Mappers\MusicToEditDtoMapper;
use App\Support\Mappers\MusicToListItemDtoMapper;
use App\Support\Mappers\PlaylistToEditDtoMapper;
use App\Support\Mappers\PlaylistToListItemDtoMapper;
use App\Support\Mappers\ShortToEditDtoMapper;
use App\Support\Mappers\ShortToListItemDtoMapper;
use App\Support\Mappers\UserToEditDtoMapper;
use App\Support\Mappers\VideoToEditDtoMapper;
use App\Support\Mappers\VideoToListItemDtoMapper;

use Config\PaginationConfig;
use Seymenkonuk\Framework\Exception\ValidationException;

class StudioService implements IStudioService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IUserRepository $userRepository,
        protected IChannelRepository $channelRepository,
        protected IVideoRepository $videoRepository,
        protected IShortRepository $shortRepository,
        protected IMusicRepository $musicRepository,
        protected IPlaylistRepository $playlistRepository,
        protected UserToEditDtoMapper $userEditMapper,
        protected ChannelToEditDtoMapper $channelEditMapper,
        protected ChannelToListItemDtoMapper $channelListItemMapper,
        protected VideoToEditDtoMapper $videoEditMapper,
        protected VideoToListItemDtoMapper $videoListItemMapper,
        protected ShortToEditDtoMapper $shortEditMapper,
        protected ShortToListItemDtoMapper $shortListItemMapper,
        protected MusicToEditDtoMapper $musicEditMapper,
        protected MusicToListItemDtoMapper $musicListItemMapper,
        protected PlaylistToEditDtoMapper $playlistEditMapper,
        protected PlaylistToListItemDtoMapper $playlistListItemMapper,
    ) {}

    // --------------------------------------------------------------------------
    // USER
    // --------------------------------------------------------------------------

    public function getUserEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Kullanıcı Detaylarını Al
        $user = $this->userRepository->findByCode($code);

        // Kullanıcı Bulunamadı
        if (!$user) {
            throw new UserNotFoundException();
        }

        // Kullanıcıyı Düzenleme Yetkisi Yok
        if (!UserPolicy::canEdit($auth, $user)) {
            throw new UserEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->userEditMapper->toArray($user);
    }

    public function changeUserPassword(
        string $code,
        string $oldPassword,
        string $newPassword,
        AuthDTO $auth,
    ): void {
        // Kullanıcı Detaylarını Al
        $user = $this->userRepository->findByCode($code);

        // Kullanıcı Bulunamadı
        if (!$user) {
            throw new UserNotFoundException();
        }

        // Kullanıcıyı Düzenleme Yetkisi Yok
        if (!UserPolicy::canEdit($auth, $user)) {
            throw new UserEditPermissionDeniedException();
        }

        // Eski Şifre Hatalı
        if (!password_verify($oldPassword, $user->password_hash)) {
            throw new ValidationException([]);
        }

        // Kullanıcıyı Düzenle
        $this->userRepository->update($code, [
            "password_hash" => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);
    }

    public function updateUser(
        string $code,
        UserEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Kullanıcı Detaylarını Al
        $user = $this->userRepository->findByCode($code);

        // Kullanıcı Bulunamadı
        if (!$user) {
            throw new UserNotFoundException();
        }

        // Kullanıcıyı Düzenleme Yetkisi Yok
        if (!UserPolicy::canEdit($auth, $user)) {
            throw new UserEditPermissionDeniedException();
        }

        // Kullanıcıyı Düzenle
        $this->userRepository->update($code, $this->userEditMapper->toModelArray($data));
    }

    public function deleteUser(
        string $code,
        AuthDTO $auth,
    ): void {
        // Kullanıcı Detaylarını Al
        $user = $this->userRepository->findByCode($code);

        // Kullanıcı Bulunamadı
        if (!$user) {
            throw new UserNotFoundException();
        }

        // Kullanıcıyı Silme Yetkisi Yok
        if (!UserPolicy::canDelete($auth, $user)) {
            throw new UserDeletePermissionDeniedException();
        }

        // Kullanıcıyı Sil
        $this->userRepository->delete($code);
    }

    // --------------------------------------------------------------------------
    // CHANNELS
    // --------------------------------------------------------------------------

    public function getChannelsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_CHANNEL_PER_PAGE,
    ): ChannelsPageDTO {
        // Bana Ait Kanalları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->channelRepository->countByUser($auth->user->code),
            $perPage,
            fn($offset, $limit) => $this->channelRepository->yieldByUser($auth->user->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new ChannelsPageDTO(
            channels: $this->channelListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getChannelEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Kanal Detaylarını Al
        $channel = $this->channelRepository->findByCode($code);

        // Kanal Bulunamadı
        if (!$channel) {
            throw new ChannelNotFoundException();
        }

        // Kanalı Düzenleme Yetkisi Yok
        if (!ChannelPolicy::canEdit($auth, $channel)) {
            throw new ChannelEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->channelEditMapper->toArray($channel);
    }

    public function updateChannel(
        string $code,
        ChannelEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Kanal Detaylarını Al
        $channel = $this->channelRepository->findByCode($code);

        // Kanal Bulunamadı
        if (!$channel) {
            throw new ChannelNotFoundException();
        }

        // Kanalı Düzenleme Yetkisi Yok
        if (!ChannelPolicy::canEdit($auth, $channel)) {
            throw new ChannelEditPermissionDeniedException();
        }

        // Kanalı Düzenle
        $this->channelRepository->update($code, $this->channelEditMapper->toModelArray($data));
    }

    public function deleteChannel(
        string $code,
        AuthDTO $auth,
    ): void {
        // Kanal Detaylarını Al
        $channel = $this->channelRepository->findByCode($code);

        // Kanal Bulunamadı
        if (!$channel) {
            throw new ChannelNotFoundException();
        }

        // Kanalı Silme Yetkisi Yok
        if (!ChannelPolicy::canDelete($auth, $channel)) {
            throw new ChannelDeletePermissionDeniedException();
        }

        // Kanalı Sil
        $this->channelRepository->delete($code);
    }

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    public function getVideosPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_VIDEO_PER_PAGE,
    ): VideosPageDTO {
        // Bana Ait Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->videoRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->videoRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new VideosPageDTO(
            videos: $this->videoListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getVideoEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Video Detaylarını Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Videoyu Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $video)) {
            throw new VideoEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->videoEditMapper->toArray($video);
    }

    public function updateVideo(
        string $code,
        VideoEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Video Detaylarını Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Videoyu Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $video)) {
            throw new VideoEditPermissionDeniedException();
        }

        // Videoyu Düzenle
        $this->videoRepository->update($code, $this->videoEditMapper->toModelArray($data));
    }

    public function deleteVideo(
        string $code,
        AuthDTO $auth,
    ): void {
        // Video Detaylarını Al
        $video = $this->videoRepository->findByCode($code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Videoyu Silme Yetkisi Yok
        if (!VideoPolicy::canDelete($auth, $video)) {
            throw new VideoDeletePermissionDeniedException();
        }

        // Videoyu Sil
        $this->videoRepository->delete($code);
    }

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getShortsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_SHORT_PER_PAGE,
    ): ShortsPageDTO {
        // Bana Ait Kısa Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->shortRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->shortRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new ShortsPageDTO(
            shorts: $this->shortListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getShortEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Kısa Video Detaylarını Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Videoyu Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $short)) {
            throw new ShortEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->shortEditMapper->toArray($short);
    }

    public function updateShort(
        string $code,
        ShortEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Kısa Video Detaylarını Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Videoyu Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $short)) {
            throw new ShortEditPermissionDeniedException();
        }

        // Kısa Videoyu Düzenle
        $this->shortRepository->update($code, $this->shortEditMapper->toModelArray($data));
    }

    public function deleteShort(
        string $code,
        AuthDTO $auth,
    ): void {
        // Kısa Video Detaylarını Al
        $short = $this->shortRepository->findByCode($code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Videoyu Silme Yetkisi Yok
        if (!VideoPolicy::canDelete($auth, $short)) {
            throw new ShortDeletePermissionDeniedException();
        }

        // Kısa Videoyu Sil
        $this->shortRepository->delete($code);
    }

    // --------------------------------------------------------------------------
    // MUSICS
    // --------------------------------------------------------------------------

    public function getMusicsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_MUSIC_PER_PAGE,
    ): MusicsPageDTO {
        // Bana Ait Müzikleri Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->musicRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->musicRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new MusicsPageDTO(
            musics: $this->musicListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getMusicEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Müzik Detaylarını Al
        $music = $this->musicRepository->findByCode($code);

        // Müzik Bulunamadı
        if (!$music) {
            throw new MusicNotFoundException();
        }

        // Müzik Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $music)) {
            throw new MusicEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->musicEditMapper->toArray($music);
    }

    public function updateMusic(
        string $code,
        MusicEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Müzik Detaylarını Al
        $music = $this->musicRepository->findByCode($code);

        // Müzik Bulunamadı
        if (!$music) {
            throw new MusicNotFoundException();
        }

        // Müzik Düzenleme Yetkisi Yok
        if (!VideoPolicy::canEdit($auth, $music)) {
            throw new MusicEditPermissionDeniedException();
        }

        // Müziği Düzenle
        $this->musicRepository->update($code, $this->musicEditMapper->toModelArray($data));
    }

    public function deleteMusic(
        string $code,
        AuthDTO $auth,
    ): void {
        // Müzik Detaylarını Al
        $music = $this->musicRepository->findByCode($code);

        // Müzik Bulunamadı
        if (!$music) {
            throw new MusicNotFoundException();
        }

        // Müzik Silme Yetkisi Yok
        if (!VideoPolicy::canDelete($auth, $music)) {
            throw new MusicDeletePermissionDeniedException();
        }

        // Müziği Sil
        $this->musicRepository->delete($code);
    }

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylistsPage(
        AuthDTO $auth,
        int $page,
        int $perPage = PaginationConfig::STUDIO_PLAYLIST_PER_PAGE,
    ): PlaylistsPageDTO {
        // Bana Ait Oynatma Listelerini Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->playlistRepository->countByChannel($auth->channel->code),
            $perPage,
            fn($offset, $limit) => $this->playlistRepository->yieldByChannel($auth->channel->code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PlaylistsPageDTO(
            playlists: $this->playlistListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getPlaylistEdit(
        string $code,
        AuthDTO $auth,
    ): array {
        // Oynatma Listesi Detaylarını Al
        $playlist = $this->playlistRepository->findByCode($code);

        // Oynatma Listesi Bulunamadı
        if (!$playlist) {
            throw new PlaylistNotFoundException();
        }

        // Oynatma Listesini Düzenleme Yetkisi Yok
        if (!PlaylistPolicy::canEdit($auth, $playlist)) {
            throw new PlaylistEditPermissionDeniedException();
        }

        // DTO'ya Dönüştür
        return $this->playlistEditMapper->toArray($playlist);
    }

    public function updatePlaylist(
        string $code,
        PlaylistEditDTO $data,
        AuthDTO $auth,
    ): void {
        // Oynatma Listesi Detaylarını Al
        $playlist = $this->playlistRepository->findByCode($code);

        // Oynatma Listesi Bulunamadı
        if (!$playlist) {
            throw new PlaylistNotFoundException();
        }

        // Oynatma Listesini Düzenleme Yetkisi Yok
        if (!PlaylistPolicy::canEdit($auth, $playlist)) {
            throw new PlaylistEditPermissionDeniedException();
        }

        // Oynatma Listesini Düzenle
        $this->playlistRepository->update($code, $this->playlistEditMapper->toModelArray($data));
    }

    public function deletePlaylist(
        string $code,
        AuthDTO $auth,
    ): void {
        // Oynatma Listesi Detaylarını Al
        $playlist = $this->playlistRepository->findByCode($code);

        // Oynatma Listesi Bulunamadı
        if (!$playlist) {
            throw new PlaylistNotFoundException();
        }

        // Oynatma Listesini Silme Yetkisi Yok
        if (!PlaylistPolicy::canDelete($auth, $playlist)) {
            throw new PlaylistDeletePermissionDeniedException();
        }

        // Oynatma Listesini Sil
        $this->playlistRepository->delete($code);
    }
}
