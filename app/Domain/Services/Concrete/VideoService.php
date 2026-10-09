<?php
// ============================================================================
// File:    VideoService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\VideoNotFoundException;
use App\Domain\Exception\Private\PrivateVideoException;
use App\Domain\Policies\VideoPolicy;
use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Services\Abstract\IVideoService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Video\InteractionDTO;
use App\Support\DTOs\Video\PageDTO;
use App\Support\DTOs\Video\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\VideoToCardDtoMapper;
use App\Support\Mappers\VideoToDetailsDtoMapper;

use Config\PaginationConfig;


class VideoService implements IVideoService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IChannelRepository $channelRepository,
        protected IVideoRepository $videoRepository,
        protected VideoToCardDtoMapper $videoCardMapper,
        protected VideoToDetailsDtoMapper $videoDetailsMapper,
    ) {}

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    public function getVideos(
        int $page,
        int $perPage = PaginationConfig::VIDEO_PER_PAGE,
    ): PaginatedDTO {
        // Public Videoları Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->videoRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->videoRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            videos: $this->videoCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getVideoPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Video Detaylarını Al
        $video = $this->videoRepository->findDetailsByCode($code, $auth?->channel->code);

        // Video Bulunamadı
        if (!$video) {
            throw new VideoNotFoundException();
        }

        // Video Görüntüleme Yetkisi Yok
        if (!VideoPolicy::canView($auth, $video)) {
            throw new PrivateVideoException();
        }

        // Videoyu Yükleyen Kanalın Detaylarını Al
        $channel = $this->channelRepository->findDetailsByCode($video->channel_code, $auth?->channel->code);
        assert($channel !== null); // Channel null dönemez

        // DTO'ya Dönüştür
        return new PageDTO(
            video: $this->videoDetailsMapper->map($video, $channel),
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
