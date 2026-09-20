<?php
// ============================================================================
// File:    VideoService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\IVideoRepository;
use App\Domain\Services\Abstract\IVideoService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Video\PageDTO;
use App\Support\DTOs\Video\PaginatedDTO;

use Config\PaginationConfig;


class VideoService implements IVideoService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IVideoRepository $videoRepository,
    ) {}

    // --------------------------------------------------------------------------
    // VIDEOS
    // --------------------------------------------------------------------------

    public function getVideos(
        int $page,
        int $perPage = PaginationConfig::VIDEO_PER_PAGE,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    public function getVideoPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        throw new \Exception('Not implemented');
    }
}
