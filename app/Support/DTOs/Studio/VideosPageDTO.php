<?php
// ============================================================================
// File:    VideosPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Studio;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Video\ListItemDTO;


readonly class VideosPageDTO
{
    /** @param Generator<int, ListItemDTO> $videos */
    public function __construct(
        public Generator        $videos,
        public PaginationDTO    $pagination,
    ) {}
}
