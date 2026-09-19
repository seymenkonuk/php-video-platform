<?php
// ============================================================================
// File:    ShortsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Short\CardDTO;


readonly class ShortsPageDTO
{
    /** @param Generator<int, CardDTO> $shorts */
    public function __construct(
        public HeaderDTO        $header,
        public Generator        $shorts,
        public PaginationDTO    $pagination,
    ) {}
}
