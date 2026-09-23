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
use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Services\Abstract\IMusicService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Music\PageDTO;
use App\Support\DTOs\Music\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\MusicToCardDtoMapper;

use Config\PaginationConfig;


class MusicService implements IMusicService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IMusicRepository $musicRepository,
        protected MusicToCardDtoMapper $musicMapper,
    ) {}

    // --------------------------------------------------------------------------
    // SHORTS
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
            musics: $this->musicMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getMusicPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Müzik Detaylarını Al
        $details = $this->musicRepository->findDetailsByCode($code, $auth?->channel->code);

        // Müzik Bulunamadı
        if (!$details) {
            throw new MusicNotFoundException();
        }

        // Müzik Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $details)) {
            throw new PrivateMusicException();
        }

        throw new \Exception('Not implemented');
        // return new PageDTO(
        //     video: $this->videoDetailsMapper->map($details),
        //     commentList: new ListDTO(
        //         data: "",
        //         enabled: false,
        //         loggedIn: $auth !== null,
        //         allowed: false,
        //         comments: (function () {
        //             yield from [];
        //         })(),
        //         count: 0,
        //         countFormatted: "0",
        //     ),
        // );
    }
}
