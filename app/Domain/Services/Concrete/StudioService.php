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
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ChannelToListItemDtoMapper;
use App\Support\Mappers\MusicToListItemDtoMapper;
use App\Support\Mappers\PlaylistToListItemDtoMapper;
use App\Support\Mappers\ShortToListItemDtoMapper;
use App\Support\Mappers\VideoToListItemDtoMapper;

use Config\PaginationConfig;


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
        protected ChannelToListItemDtoMapper $channelListItemMapper,
        protected VideoToListItemDtoMapper $videoListItemMapper,
        protected ShortToListItemDtoMapper $shortListItemMapper,
        protected MusicToListItemDtoMapper $musicListItemMapper,
        protected PlaylistToListItemDtoMapper $playlistListItemMapper,
    ) {}

    // --------------------------------------------------------------------------
    // USER
    // --------------------------------------------------------------------------

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
