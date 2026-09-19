<?php
// ============================================================================
// File:    ChannelsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Studio;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Channel\ListItemDTO;


readonly class ChannelsPageDTO
{
    /** @param Generator<int, ListItemDTO> $channels */
    public function __construct(
        public Generator        $channels,
        public PaginationDTO    $pagination,
    ) {}
}
