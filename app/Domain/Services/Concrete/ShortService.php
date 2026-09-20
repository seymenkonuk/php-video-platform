<?php
// ============================================================================
// File:    ShortService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\IShortRepository;
use App\Domain\Services\Abstract\IShortService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Short\PageDTO;
use App\Support\DTOs\Short\PaginatedDTO;

use Config\PaginationConfig;


class ShortService implements IShortService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected IShortRepository $shortRepository,
    ) {}

    // --------------------------------------------------------------------------
    // SHORTS
    // --------------------------------------------------------------------------

    public function getShorts(
        int $page,
        int $perPage = PaginationConfig::SHORT_PER_PAGE,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    public function getShortPage(
        string $code,
        ?AuthDTO $auth = null,
    ): PageDTO {
        throw new \Exception('Not implemented');
    }
}
