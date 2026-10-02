<?php
// ============================================================================
// File:    ShortService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\ShortNotFoundException;
use App\Domain\Exception\Private\PrivateShortException;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Services\Abstract\IShortService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Short\PageDTO;
use App\Support\DTOs\Short\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\ShortToCardDtoMapper;
use App\Support\Mappers\ShortToDetailsDtoMapper;

use Config\PaginationConfig;


class ShortService implements IShortService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IShortRepository $shortRepository,
        protected ShortToCardDtoMapper $shortCardMapper,
        protected ShortToDetailsDtoMapper $shortDetailsMapper,
    ) {}

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getShorts(
        int $page,
        int $perPage = PaginationConfig::SHORT_PER_PAGE,
    ): PaginatedDTO {
        // Public Kısa Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->shortRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->shortRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            shorts: $this->shortCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getShortPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Kısa Video Detaylarını Al
        $short = $this->shortRepository->findDetailsByCode($code, $auth?->channel->code);

        // Kısa Video Bulunamadı
        if (!$short) {
            throw new ShortNotFoundException();
        }

        // Kısa Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $short)) {
            throw new PrivateShortException();
        }

        // Kısa Videoyu Yükleyen Kanalın Detaylarını Al
        $channel = $this->channelRepository->findDetailsByCode($short->channel_code, $auth?->channel->code);
        assert($channel !== null); // Channel null dönemez

        // DTO'ya Dönüştür
        return new PageDTO(
            short: $this->shortDetailsMapper->map($short, $channel),
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
}
