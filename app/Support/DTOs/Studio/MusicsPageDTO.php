<?php
// ============================================================================
// File:    MusicsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Studio;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Music\ListItemDTO;


readonly class MusicsPageDTO
{
    /** @param Generator<int, ListItemDTO> $musics */
    public function __construct(
        public Generator        $musics,
        public PaginationDTO    $pagination,
    ) {}
}
