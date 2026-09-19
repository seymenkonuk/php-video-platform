<?php
// ============================================================================
// File:    HistoryPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Feed;


use Generator;

use App\Support\DTOs\Library\HistoryHeaderDTO;
use App\Support\DTOs\Playlist\ItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class HistoryPageDTO
{
    /** @param Generator<int, ?ItemDTO> $videos  */
    public function __construct(
        public HistoryHeaderDTO       $header,
        public Generator            $videos,
        public PaginationDTO        $pagination,
    ) {}
}
