<?php
// ============================================================================
// File:    VideosPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Video\CardDTO;


readonly class VideosPageDTO
{
    /** @param Generator<int, CardDTO> $videos */
    public function __construct(
        public HeaderDTO        $header,
        public Generator        $videos,
        public PaginationDTO    $pagination,
    ) {}
}
