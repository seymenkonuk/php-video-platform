<?php
// ============================================================================
// File:    PlaylistService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\PlaylistNotFoundException;
use App\Domain\Exception\Private\PrivatePlaylistException;
use App\Domain\Policies\PlaylistPolicy;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IPlaylistRepository;
use App\Domain\Repositories\Abstract\IPlaylistContentRepository;
use App\Domain\Services\Abstract\IPlaylistService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Playlist\PageDTO;
use App\Support\DTOs\Playlist\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\PlaylistToCardDtoMapper;
use App\Support\Mappers\PlaylistToHeaderDtoMapper;
use App\Support\Mappers\VideoToPlaylistItemDtoMapper;

use Config\PaginationConfig;


class PlaylistService implements IPlaylistService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IPlaylistRepository $playlistRepository,
        protected IPlaylistContentRepository $playlistContentRepository,
        protected PlaylistToCardDtoMapper $playlistCardMapper,
        protected PlaylistToHeaderDtoMapper $playlistHeaderMapper,
        protected VideoToPlaylistItemDtoMapper $videoPlaylistItemMapper,
    ) {}

    // --------------------------------------------------------------------------
    // PLAYLISTS
    // --------------------------------------------------------------------------

    public function getPlaylists(
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_PER_PAGE,
    ): PaginatedDTO {
        // Public Oynatma Listelerini Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->playlistRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->playlistRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            playlists: $this->playlistCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getPlaylistPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::PLAYLIST_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Oynatma Listesi Detaylarını Al
        $details = $this->playlistRepository->findDetailsByCode($code);

        // Oynatma Listesi Bulunamadı
        if (!$details) {
            throw new PlaylistNotFoundException();
        }

        // Oynatma Listesi Görüntüleme Yetkisi Yok
        if (!PlaylistPolicy::canView($auth, $details)) {
            throw new PrivatePlaylistException();
        }

        // Oynatma Listesi Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->playlistContentRepository->countByPlaylist($code),
            $perPage,
            fn($offset, $limit) => $this->playlistContentRepository->yieldByPlaylist($code, $offset, $limit),
        );

        // Videoları Görüntüleme Yetkisine Göre Filtrele
        $videos = (function () use ($code, $page, $perPage, $paginated, $auth) {
            $index = ($page - 1) * $perPage;
            foreach ($paginated["data"] as $video) {
                $index++;
                if (VideoPolicy::canList($auth, $video)) {
                    yield $this->videoPlaylistItemMapper->map($video, $code, $index);
                } else {
                    yield null;
                }
            }
        })();

        // DTO'ya Dönüştür
        return new PageDTO(
            header: $this->playlistHeaderMapper->map($details),
            videos: $videos,
            pagination: $paginated["pagination"],
        );
    }
}
