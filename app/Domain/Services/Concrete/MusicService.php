<?php
// ============================================================================
// File:    MusicService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\IMusicRepository;
use App\Domain\Services\Abstract\IMusicService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Music\PageDTO;
use App\Support\DTOs\Music\PaginatedDTO;

use Config\PaginationConfig;


class MusicService implements IMusicService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IMusicRepository $musicRepository,
    ) {}

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getMusics(
        int $page,
        int $perPage = PaginationConfig::MUSIC_PER_PAGE,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    public function getMusicPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        throw new \Exception('Not implemented');
    }
}
