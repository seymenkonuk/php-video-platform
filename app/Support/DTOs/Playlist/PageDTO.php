<?php
// ============================================================================
// File:    PageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use Generator;

use App\Support\DTOs\Playlist\ItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class PageDTO
{
    /** @param Generator<int, ?ItemDTO> $videos */
    public function __construct(
        public HeaderDTO $header,
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
