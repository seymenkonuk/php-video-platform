<?php
// ============================================================================
// File:    ShortsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Studio;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Short\ListItemDTO;


readonly class ShortsPageDTO
{
    /** @param Generator<int, ListItemDTO> $shorts */
    public function __construct(
        public Generator        $shorts,
        public PaginationDTO    $pagination,
    ) {}
}
