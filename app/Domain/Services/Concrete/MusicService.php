<?php
// ============================================================================
// File:    MusicService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\MusicNotFoundException;
use App\Domain\Exception\Private\PrivateMusicException;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Services\Abstract\IMusicService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Music\InteractionDTO;
use App\Support\DTOs\Music\PageDTO;
use App\Support\DTOs\Music\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\MusicToCardDtoMapper;
use App\Support\Mappers\MusicToDetailsDtoMapper;

use Config\PaginationConfig;


class MusicService implements IMusicService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IMusicRepository $musicRepository,
        protected MusicToCardDtoMapper $musicCardMapper,
        protected MusicToDetailsDtoMapper $musicDetailsMapper,
    ) {}

    // --------------------------------------------------------------------------
    // MUSICS
    // --------------------------------------------------------------------------

    public function getMusics(
        int $page,
        int $perPage = PaginationConfig::MUSIC_PER_PAGE,
    ): PaginatedDTO {
        // Public Müzikleri Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->musicRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->musicRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            musics: $this->musicCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getMusicPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Müzik Detaylarını Al
        $music = $this->musicRepository->findDetailsByCode($code, $auth?->channel->code);

        // Müzik Bulunamadı
        if (!$music) {
            throw new MusicNotFoundException();
        }

        // Müzik Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $music)) {
            throw new PrivateMusicException();
        }

        // Müziği Yükleyen Kanalın Detaylarını Al
        $channel = $this->channelRepository->findDetailsByCode($music->channel_code, $auth?->channel->code);
        assert($channel !== null); // Channel null dönemez

        // DTO'ya Dönüştür
        return new PageDTO(
            music: $this->musicDetailsMapper->map($music, $channel),
            commentList: new ListDTO(
                data: "",
                enabled: false,
                loggedIn: $auth !== null,
                allowed: false,
                comments: (function () {
                    yield from [];
                })(),
                count: 0,
                countFormatted: "0",
            ),
        );
    }

    // --------------------------------------------------------------------------
    // INTERACTIONS
    // --------------------------------------------------------------------------

    public function toggleLike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO {
        throw new \Exception("Not implemented");
    }

    public function toggleDislike(
        string $code,
        AuthDTO $auth,
    ): InteractionDTO {
        throw new \Exception("Not implemented");
    }

    public function toggleWatchLater(
        string $code,
        AuthDTO $auth,
    ): bool {
        throw new \Exception("Not implemented");
    }
}
